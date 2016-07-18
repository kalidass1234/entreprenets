<?php

/**
 * Allow affiliate to see there leads in member area
 *
 */
class Am_Plugin_AffLeads extends Am_Plugin
{

    const
        PLUGIN_STATUS = self::STATUS_BETA;
    const
        PLUGIN_COMM = self::COMM_COMMERCIAL;
    const
        PLUGIN_REVISION = '@@VERSION@@';

    protected
        $_configPrefix = 'misc.';

    function _initSetupForm(Am_Form_Setup $form)
    {
        $form->addAdvCheckbox('allow_export')->setLabel(___('Allow to export Leads'));
        $form->addAdvCheckbox('allow_filter')->setLabel(___('Allow to filter Leads'));
        $form->addMagicSelect('fields', '', array('options' => $this->getUserFields()))->setLabel(___('Show these fields'));
        $form->setDefault('fields', $this->getDefaultFields());
        return $form;
    }

    function getDefaultFields()
    {
        return array('name', 'email', 'added');
    }

    function onUserMenu(Am_Event $e)
    {
        $menu = $e->getMenu();
        $page = $menu->findById('aff');
        if ($page)
        {
            $page->addPage(array(
                'id' => 'aff-leads',
                'controller' => 'aff-leads',
                'label' => ___('Your Leads'),
            ));
        }
    }

    function getUserFields()
    {
        $fields = array(
            'name' => ___('Name'),
            'name_f' => ___('First Name'),
            'name_l' => ___('Last Name'),
            'email' => ___('E-Mail'),
            'street' => ___('Street'),
            'city' => ___('City'),
            'state' => ___('State'),
            'full_state' => ___('State Title'),
            'country' => ___('Country'),
            'full_country' => ___('Country Title'),
            'zip' => ___('Postal Index'),
            'phone' => ___('Phone'),
            'login' => ___('Username'),
            'added' => ___('Added'),
        );

        foreach ($this->getDi()->userTable->customFields()->getAll() as $field)
        {
            if (isset($field->from_config) && $field->from_config)
            {
                if ($field->sql)
                {
                    $fields[$field->name] = $field->title;
                }
                else
                {
                    $fields['__data_' . $field->name] = $field->title;
                }
            }
        }

        return $fields;
    }

}

class AffLeadsController extends Am_Controller_Grid
{

    protected
        $layout = 'member/layout.phtml';

    public
        function preDispatch()
    {
        $this->getDi()->auth->requireLogin(ROOT_URL . '/aff-leads');
        if (!$this->getDi()->user->is_affiliate)
            $this->_redirect('member');
        parent::preDispatch();
    }

    public
        function createGrid()
    {
        $ds = new Am_Query($this->getDi()->userTable);
        $ds->leftJoin('?_country', 'c', 't.country = c.country');
        $ds->leftJoin('?_state', 's', 't.country = s.country and t.state=s.state');
        $ds->addField('concat(t.name_f, " ", t.name_l)', 'name');
        $ds->addField('c.title', 'full_country');
        $ds->addField('s.title', 'full_state');
        $ds = $ds->addOrder('added', true)
            ->addWhere('aff_id=?', $this->getDi()->auth->getUserId());
        $grid = new Am_Grid_Editable('_al', ___('Affiliate Leads'), $ds, $this->_request, $this->view, $this->getDi());
        $grid->actionsClear();

        if ($this->getPluginConfig('allow_export'))
            $grid->actionAdd(new Am_Grid_Action_Export('_export', ___('Export')));

        $fieldTitles = $this->getPlugin()->getUserFields();
        foreach ($this->getPluginConfig('fields', $this->getPlugin()->getDefaultFields()) as $field)
        {
            switch ($field)
            {
                case 'added' :
                    $grid->addField(new Am_Grid_Field_Date('added', ___('Date/Time')));
                    break;
                default:
                    $grid->addField($this->createField($field, $fieldTitles[$field]));
            }
        }

        if ($this->getPluginConfig('allow_filter'))
            $grid->setFilter(new Am_Grid_Filter_AffLeads());

        return $grid;
    }

    function createField($field, $title)
    {

        $f = new Am_Grid_Field($field, $title, (strpos($field, '__data_') !== false ? false : true));
        $f->setGetFunction(array($this, 'getFieldValue'));
        return $f;
    }
    function getFieldValue(Am_Record $record, $controller, $field)
    {
        if (strpos($field, '__data_') !== false)
        {
            $key = str_replace('__data_', '', $field);
            $value = $record->data()->get($key);
        }
        else
        {
            $value = $record->get($field);
        }
        if (is_array($value))
            $value = implode(", ", $value);

        return $value;
    }


    /**
     * 
     * @return Am_Plugin_AffLeads
     */
    function getPlugin()
    {
        return $this->getDi()->plugins_misc->loadGet('aff-leads');
    }

    function getPluginConfig($key, $default = null)
    {
        return $this->getPlugin()->getConfig($key, $default);
    }

}

class Am_Grid_Filter_AffLeads extends Am_Grid_Filter_Abstract
{

    protected
        function applyFilter()
    {
        $ds = $this->grid->getDataSource();
        $filter = $this->vars['filter'];
        if (@$filter['dat1'])
            $ds->addWhere('t.added>=?', Am_Form_Element_Date::createFromFormat(null, $filter['dat1'])->format('Y-m-d 00:00:00'));
        if (@$filter['dat2'])
            $ds->addWhere('t.added<=?', Am_Form_Element_Date::createFromFormat(null, $filter['dat2'])->format('Y-m-d 23:59:59'));

        $field = empty($filter['field']) ? 'name' : $filter['field'];

        if (!empty($filter['text']))
            $ds->addHaving($this->grid->getDi()->db->escapeWithPlaceholders('(?# LIKE ?)', $field, '%' . $filter['text'] . '%'));
    }

    public
        function getEnabledFields()
    {
        $plugin = $this->grid->getDi()->plugins_misc->loadGet('aff-leads');
        $fieldTitles = $plugin->getUserFields();
        $fields = $plugin->getConfig('fields', $plugin->getDefaultFields());
        $options = array();
        foreach ($fields as $field)
        {
            if (strpos($field, '__data_') !== false)
                continue;
            $options[$field] = $fieldTitles[$field];
        }
        return $options;
    }

    public
        function renderInputs()
    {
        $prefix = $this->grid->getId();

        $dat1 = @$this->vars['filter']['dat1'];
        $dat2 = @$this->vars['filter']['dat2'];
        $filter = @$this->vars['filter']['text'];
        $start = ___('Start Date');
        $end = ___('End Date');
        $text_filter_title = ___('Filter Text');
        $options = Am_Controller::renderOptions(array_merge(array('' => '-- ' . ___('Select Search Criteria') . ' --'), $this->getEnabledFields()), @$this->vars['filter']['field']);

        return <<<CUT
<input type="text" placeholder="$start" name="{$prefix}_filter[dat1]" class='datepicker' style="width:80px" value="{$dat1}" />
<input type="text" placeholder="$end" name="{$prefix}_filter[dat2]" class='datepicker' style="width:80px" value="{$dat2}" />
<select name="{$prefix}_filter[field]">
{$options}
</select>
<input type="text" placeholder="$text_filter_title" name="{$prefix}_filter[text]" value="{$filter}" style="width:190px" />
CUT;
    }

    function getTitle()
    {
        return ___('Filter Leads');
    }

}