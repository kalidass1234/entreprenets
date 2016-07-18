<?php

/**
 * Plugin allows to sell "credits" - count of credits will be configured
 * in product billing plan settings, and added to user account after purchase
 *
 * Code to deduct "credits" must be implemented by your system
 *
 * Credits are not expiring with subscription (!)
 * aMember does not take account of subscription dates at all when accounting credits
 * Once accounted, credit records are not updated if product setting changed
 *
 * @example
 *     
 *      // with comment
 *      Am_Di::getInstance()->plugins_misc->loadGet('credits')->debit(120, "Used 120 credits");
 *      // debit 120 credits from user# 1234
 *      Am_Di::getInstance()->plugins_misc->loadGet('credits')->debit(120, "Used 120 credits", 1234);
 *      // balance - get current number of credits
 *      Am_Di::getInstance()->plugins_misc->loadGet('credits')->balance();
 *
 */
class Am_Plugin_Credits extends Am_Plugin
{
    const PLUGIN_STATUS = self::STATUS_BETA;
    const PLUGIN_COMM = self::COMM_COMMERCIAL;
    const PLUGIN_REVISION = '4.4.4';

    protected $_table;

    ////////////////////////// PUBLIC API FUNCTIONS ////////////////////
    /**
     * Debit (-) credits from user account
     * @param int $credits required, count of credits to deduct (positive)
     * @param string $comment required, description of transaction
     * @param int $user_id optional, uses user_id from session by default
     * @param string $reference_id optional, id of transaction in third-party database
     * @return int credit_id value of inserted record
     */
    function debit($credits, $comment, $user_id=null, $reference_id = null)
    {
        if ($credits <= 0)
            throw new Am_Exception_InternalError("\$credits must be not-zero in " . __METHOD__);
        $this->_insert(-$credits, $comment, $user_id, $reference_id);
    }

    /**
     * Credit (+) credits to user account
     * @param int $credits required, count of credits to deduct
     * @param string $comment required, description of transaction
     * @param int $user_id optional, uses user_id from session by default
     * @param string $reference_id optional, id of transaction in third-party database
     * @return int credit_id value of inserted record
     */
    function credit($credits, $comment, $user_id=null, $reference_id = null)
    {
        if ($credits <= 0)
            throw new Am_Exception_InternalError("\$credits must be not-zero in " . __METHOD__);
        return $this->_insert($credits, $comment, $user_id, $reference_id);
    }

    /**
     * Return customer balance to today or to specified date
     * @return int credits balance to date (default to current date)
     */
    function balance($user_id=null, $date=null)
    {
        if (!$user_id)
        {
            $user_id = $this->getDi()->auth->getUserId();
            if (!$user_id)
                throw new Am_Exception_InternalError("user_id must be specified or user must be logged-in to run " . __METHOD__);
        }
        return (int) $this->getDi()->db->selectCell("SELECT SUM(`value`) FROM ?_credit
            WHERE user_id=?d
                { AND dattm <= ?}", $user_id, $date !== null ? sqlDate($date) : DBSIMPLE_SKIP);
    }

    ////////////////////////// PLUGIN FUNCTIONS ////////////////////

    public function _initSetupForm(Am_Form_Setup $form)
    {
        $form->addElement('advcheckbox', 'credits.hide_credit_history_tab')
            ->setLabel(___("Do not show 'Credits History' tab at User Menu"));

        $form->addElement('advcheckbox', 'credits.hide_credit_balance_link')
            ->setLabel(___("Do not show 'Credits Balance' link at Useful Links"));

        $form->addElement('integer', 'credits.count_row_page')
            ->setLabel(___("Rows Count per Page at Credits History page\n" .
                "empty - it uses global settings"));
    }
    
    public function getReadme()
    {
        return "<a href='http://www.amember.com/docs/Integration/Credits'>http://www.amember.com/docs/Integration/Credits</a>";
    }
    
    public function init()
    {
        $this->getDi()->productTable->customFields()->add(new Am_CustomFieldText('credit', 'Number of credits'));
    }

    function onAccessAfterInsert(Am_Event $event)
    {
        $this->_update($event->getAccess()->user_id);
    }

    function onAccessAfterDelete(Am_Event $event)
    {
        $this->_update($event->getAccess()->user_id);
    }

    function onAccessAfterUpdate(Am_Event $event)
    {
        $this->_update($event->getAccess()->user_id);
    }

    function _update($user_id)
    {
        // delete credits with removed "access"
        $ids = $this->getDi()->db->selectCol("
                SELECT credit_id
                FROM ?_credit c LEFT JOIN ?_access a USING (access_id)
                WHERE c.user_id=?d AND c.access_id > 0 AND a.access_id is NULL", $user_id);
        if ($ids)
            $this->getDi()->db->query("DELETE FROM ?_credit WHERE credit_id IN (?a)", $ids);

        // insert records with no related "credit"
        $this->getDi()->db->select("
            INSERT INTO ?_credit 
            SELECT 
                null as credit_id,
                IFNULL(p.dattm, a.begin_date) as dattm,
                a.user_id,
                d.`value`*it.qty as `value`,
                pr.title as comment,
                a.access_id,
                null as reference_id
            FROM ?_access a 
                LEFT JOIN ?_credit c ON a.access_id = c.access_id
                INNER JOIN ?_data d ON d.`table`='product' 
                    AND d.`id`=a.product_id AND d.`key`='credit' AND d.`value` > 0
                LEFT JOIN ?_invoice_payment p ON a.invoice_payment_id=p.invoice_payment_id
                LEFT JOIN ?_invoice_item it ON it.invoice_id = a.invoice_id and it.item_id=a.product_id
                LEFT JOIN ?_product pr ON a.product_id = pr.product_id
            WHERE a.user_id=?d AND c.credit_id IS NULL
        ", $user_id);
    }

    /**
     * @return Am_Table 
     */
    function getTable()
    {
        if (!$this->_table)
        {
            $this->_table = new Am_Table($this->getDi()->db, '?_credit', 'credit_id');
            $this->_table->setDi($this->getDi());
        }
        return $this->_table;
    }

    public static function activate($id, $pluginType)
    {
        $di = Am_Di::getInstance();
        $di->db->query("CREATE TABLE IF NOT EXISTS ?_credit (
            credit_id int not null auto_increment PRIMARY KEY,
            dattm datetime not null,
            user_id int not null,
            value int not null comment 'positive value: credit, negavive value: debit',
            comment varchar(255) not null comment 'useful for debit comments',
            access_id int null comment 'will be set to related access_id for credit records',
            reference_id varchar(255) null comment 'you can set it to your internal operation reference# to link, is not used in aMember',
            INDEX (user_id, dattm)
        ) CHARACTER SET utf8 COLLATE utf8_general_ci");
    }

    protected function _insert($credits, $comment, $user_id=null, $reference_id = null)
    {
        if (!$user_id)
        {
            $user_id = $this->getDi()->auth->getUserId();
            if (!$user_id)
                throw new Am_Exception_InternalError("user_id must be specified or user must be logged-in to run " . __METHOD__);
        }

        $d = $this->getTable()->createRecord();
        $d->user_id = $user_id;
        $d->dattm = $this->getDi()->sqlDateTime;
        $d->value = (int) $credits;
        $d->comment = $comment;
        $d->reference_id = $reference_id;
        $d->insert();
        return $d->pk();
    }

    function onUserTabs(Am_Event_UserTabs $event)
    {
        if ($event->getUserId() > 0)
            $event->getTabs()->addPage(array(
                'id' => 'credits',
                'controller' => 'admin-credits',
                'action' => 'index',
                'params' => array(
                    'user_id' => $event->getUserId(),
                ),
                'label' => ___('Credits'),
                'order' => 1000
            ));
    }

    public function onUserMenu(Am_Event $event)
    {
        if (!$this->getDi()->config->get('credits.hide_credit_history_tab'))
        {
            $menu = $event->getMenu();
            $menu->addPage(array(
                'id' => 'credits',
                'controller' => 'credits',
                'action' => 'index',
                'label' => ___('Credits History'),
                'order' => 1000,
            ));
        }
    }

    function onGetMemberLinks(Am_Event $event)
    {
        if (!$this->getDi()->config->get('credits.hide_credit_balance_link'))
            $event->addReturn(
                ___("Your Credits Balance: ") . $this->getDi()->plugins_misc->loadGet('credits')->balance(),
                ROOT_URL . '/credits'
            );
    }

}

class Credit extends Am_Record
{

    protected $_key = 'credit_id';
    protected $_table = '?_credit';

}

class CreditTable extends Am_Table
{

    protected $_key = 'credit_id';
    protected $_table = '?_credit';
    protected $_recordClass = 'Credit';

}

class AdminCreditsController extends Am_Controller_Grid
{

    protected $layout = 'admin/user-layout.phtml';

    public function checkAdminPermissions(Admin $admin)
    {
        return true;
    }

    function createGrid()
    {
        $ds = new Am_Query($this->getDi()->creditTable);
        $ds = $ds->addWhere('user_id=?', $this->user_id);
        $grid = new Am_Grid_Editable('_credits', ___('Credits'), $ds, $this->getRequest(), $this->getView(), $this->getDi());
        $grid->addField(new Am_Grid_Field_Date('dattm', ___('Date')));
        $grid->addField('value', ___('Value'));
        $grid->addField('comment', ___('Comment'));
        $grid->setForm(array($this, 'createForm'));
        $grid->addCallback(Am_Grid_Editable::CB_VALUES_FROM_FORM, array($this, 'valuesFromForm'));
        $grid->addCallback(Am_Grid_ReadOnly::CB_RENDER_STATIC, array($this, 'renderStatic'));
        $grid->addCallback(Am_Grid_ReadOnly::CB_TR_ATTRIBS, array($this, 'cbGetTrAttribs'));
        $grid->actionsClear();
        $grid->actionAdd(new Am_Grid_Action_Insert());
        return $grid;
    }

    public function cbGetTrAttribs(& $ret, $record)
    {
        if ($record->value < 0)
        {
            $ret['class'] = isset($ret['class']) ? $ret['class'] . ' debit' : 'debit';
        }
    }

    function renderStatic(& $out)
    {
        $out .= <<<CUT
    <style type="text/css">
    <!--
    tr.debit {
       color: #C43D33;
    }
    -->
    </style>
CUT;
        $out .= "<h1 id='credit-balance'>Credits Balance: " . $this->getDi()->plugins_misc->loadGet('credits')->balance($this->user_id) . "</h1>";
        $out .= "<script type=\"text/javascript\">jQuery(function($){ $('#credit-balance').insertBefore($('#grid-credits')); });</script>";
    }

    function valuesFromForm(& $values)
    {
        if ($values['_type'] == 'debit')
        {
            $values['value'] = -1 * $values['value'];
        }

        $values['user_id'] = $this->user_id;
    }

    function createForm()
    {
        $form = new Am_Form_Admin('credits');

        $form->addSelect('_type')
            ->setLabel('Type')
            ->loadOptions(array(
                'credit' => 'Credit',
                'debit' => 'Debit'
            ));

        $value = $form->addText('value')
                ->setLabel('Value');

        $value->setValue(0);
        $value->addRule('required');

        $dattm = $form->addDate('dattm')
                ->setLabel('Date');

        $dattm->setValue(date('Y-m-d'));
        $dattm->addRule('required');

        $form->addTextarea('comment')
            ->setLabel('Comment');

        return $form;
    }

    function preDispatch()
    {
        require_once APPLICATION_PATH . '/default/controllers/AdminUsersController.php';
        $this->setActiveMenu('users-browse');

        $this->user_id = $this->getInt('user_id');
        if (!$this->user_id)
            throw new Am_Exception_InputError("Wrong URL specified: no member# passed");

        parent::preDispatch();
    }

}

class CreditsController extends Am_Controller_Grid
{

    protected $layout = 'layout.phtml';

    function createGrid()
    {
        $ds = new Am_Query($this->getDi()->creditTable);
        $ds = $ds->addWhere('user_id=?', $this->user_id);
        $grid = new Am_Grid_ReadOnly('_credits', ___('Credits'), $ds, $this->getRequest(), $this->getView(), $this->getDi());
        $grid->setCountPerPage(
            Am_Di::getInstance()->config->get('credits.count_row_page', Am_Di::getInstance()->config->get('admin.records-on-page', 10))
        );
        $grid->addField(new Am_Grid_Field_Date('dattm', ___('Date')));
        $grid->addField('value', ___('Value'));
        $grid->addField('comment', ___('Comment'));
        $grid->addCallback(Am_Grid_ReadOnly::CB_RENDER_STATIC, array($this, 'renderStatic'));
        $grid->addCallback(Am_Grid_ReadOnly::CB_TR_ATTRIBS, array($this, 'cbGetTrAttribs'));
        return $grid;
    }

    public function cbGetTrAttribs(& $ret, $record)
    {
        if ($record->value < 0)
            $ret['class'] = isset($ret['class']) ? $ret['class'] . ' debit' : 'debit';
    }

    function renderStatic(& $out, Am_Grid_ReadOnly $grid)
    {
        $out .= <<<CUT
    <style type="text/css">
    <!--
    tr.debit {
       color: #C43D33;
    }
    -->
    </style>
CUT;
        $out .= "<h1 id='credit-balance'>".___('Credits Balance').": " . $this->getDi()->plugins_misc->loadGet('credits')->balance() . "</h1>";
        $out .= "<script type=\"text/javascript\">jQuery(function($){ $('#credit-balance').insertBefore($('#grid-credits')); });</script>";
    }

    function preDispatch()
    {
        $this->getDi()->auth->requireLogin($this->getUrl());
        $this->user_id = $this->getDi()->auth->getUserId();
        if ($this->getDi()->config->get('credits.hide_credit_history_tab')
            && $this->getDi()->config->get('credits.hide_credit_balance_link'))
            throw new Am_Exception_AccessDenied("You have no enough permissions for this operation");

        parent::preDispatch();
    }

}