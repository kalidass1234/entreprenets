<?php

class_exists('Am_Form');

/**
 * It is important to remove all commission rules in aMember
 * You can define absolute commissions by tier in array tiers
 *
 * Affiliates Signup Type should be 'All new users automatically become affiliates'
 *
 */
class Am_Plugin_AffForcedMatrix extends Am_Plugin
{
    const PLUGIN_STATUS = self::STATUS_BETA;
    const PLUGIN_COMM = self::COMM_COMMERCIAL;
    const PLUGIN_REVISION = '@@VERSION@@';

    const COMM_FIXED = 'number';
    const COMM_PERCENT = 'percent';

    protected $_configPrefix = 'misc.';
    protected $tiers = array(
        0 => 8,
        1 => 4,
        2 => 3,
        3 => 4,
        4 => 4
    );

    public function init()
    {
        $name = 'misc.aff-forced-matrix.notify_new_lead';
        $subject = 'Dear %affiliate.name_f% %affiliate.name_l%, new student join your downline!';
        $body = <<<CUT
Dear  %affiliate.name_f% %affiliate.name_l%,

New student join your downline: %user.name_f% %user.name_l%

If you need some help, you can visit our helpdesk area.

To login to your member pages, please click on the link below:
%root_url%/login

--
Best Regards,
%site_title%
%root_url%
CUT;
        $di = Am_Di::getInstance();
        $cnt = $di->db->selectCell("SELECT COUNT(*) AS cnt FROM ?_email_template WHERE name = ?", $name);
        if (!$cnt) {
            $di->db->query("INSERT INTO ?_email_template (name,lang,format,subject,txt) VALUES (?,?,?,?,?)", $name, 'en', 'text', $subject, $body);
        }
    }

    public function getLevel()
    {
        return count($this->tiers);
    }

    public function onInitFinished(Am_Event $e)
    {
        $di = $this->getDi();
        $table = new AffCommissionRuleTableNull($di->db);
        $table->setDi($di);
        $di->setService('affCommissionRuleTable', $table);
    }

    public function onAdminMenu(Am_Event $e)
    {
        $m = $e->getMenu();
        $page = $m->findOneBy('id', 'affiliates-commission-rules');
        $parent = $m->findOneBy('id', 'affiliates');
        if ($parent && $page) {
            $parent->removePage($page);
        }
    }

    function onSetupEmailTemplateTypes(Am_Event $event)
    {
        $event->addReturn(array(
            'id' => 'misc.aff-forced-matrix.notify_new_lead',
            'title' => ___('Notify Affiliate about new students in his downline'),
            'mailPeriodic' => Am_Mail::PRIORITY_LOW,
            'vars' => array('user', 'affiliate'),
            ), 'misc.aff-forced-matrix.notify_new_lead');
    }

    public function _initSetupForm(Am_Form_Setup $form)
    {
        $form->setTitle(___('Forced Matrix'));

        $form->addText('comm')
                ->setLabel(___("Commission for first Payment, %\n" .
                        '(default)'))
            ->default = 100;

        $fs = $form->addGroup()
            ->setLabel(___("Commission for first Payment by Product, %\n" .
                "you can change commission for first payment on per product basis."));

        foreach (Am_Di::getInstance()->productTable->getOptions() as $k => $v) {
            $fs->addText('product_comm.' . $k, array('class' => 'product_comm-helper'));
        }

        $el = $fs->addElement(new Am_Form_Element_FirstCommission('product_comm', array('id' => 'product_comm')));

        $product_comm = $this->getConfig('product_comm', array());
        foreach (Am_Di::getInstance()->productTable->getOptions() as $k => $v) {
            $val = isset($product_comm[$k]) ? $product_comm[$k] : '';
            $attr = array(
                'data-label' => $v . sprintf(' <input style="padding:0" type="text" onChange = "$(this).closest(\'div\').find(\'input[type=hidden]\').val($(this).val())"  name="" size="4" value="%s" /> %%', $val),
                'data-value' => $val
            );
            $el->addOption($v, $k, $attr);
        }

        $el->setJsOptions('{
            getOptionName : function (name, option) {
                return name.replace(/\[\]$/, "") + "___" + option.value;
            },
            getOptionValue : function (option) {
                return $(option).data("value");
            }
        }');
        $el->setValue(array_keys(array_filter($product_comm)));
        $fs->addScript()
            ->setScript(<<<CUT
$('.product_comm-helper').hide();
$('.product_comm-helper').val('');
CUT
        );

        for ($i = 0; $i < count($this->tiers); $i++) {
            $gr = $form->addGroup()
                ->setLabel(sprintf('Commission [Tier %d], $', $i + 1))
                ->setSeparator(' ');

            $gr->addText('tiers_' . $i, array('size' => 5))
                ->default = $this->tiers[$i];
            $gr->addSelect('tiers_type_' . $i)
                ->loadOptions(array(
                    self::COMM_FIXED => Am_Currency::getDefault(),
                    self::COMM_PERCENT => '%'
                ));
        }

        $form->addAdvCheckbox('hourly_pending_remove')
            ->setLabel(___('Remove Pending Users Hourly'));

        $form->addElement('email_checkbox', 'notify_new_lead')
            ->setLabel(___("Notify Affiliate about new students in his downline"));

        $form->addMagicSelect('product_ids')
            ->setLabel(___("Calculate commission only for following products\n" .
                    "leave it empty if you want to pay commission for all products"))
            ->loadOptions($this->getDi()->productTable->getOptions());


        $form->addElement(new Am_Form_Element_SortableList("priority"))
            ->loadOptions($this->getDi()->productTable->getOptions())
            ->setLabel(___("Product Priority\n" .
                    "you may drag and drop products to sort it.\n" .
                    "if there are several products available for user\n" .
                    "aMember will choose product that are higher\n" .
                    "in this list to show in matrix"));

        $form->addAdvCheckbox('product_adv')
            ->setId('product_adv')
            ->setLabel('Enable Advanced Product Rules');

        $fs = $form->addAdvFieldset()
            ->setId('cp')
            ->setLabel(___('Commission by product'));

        $pOptions = $this->getDi()->productTable->getOptions();

        foreach ($pOptions as $pid => $title) {
            $fs->addMagicSelect('product_' . $pid)
                ->setLabel($title)
                ->loadOptions($pOptions);
        }

        $form->addScript()
            ->setScript(<<<CUT
$(function(){
    $('#product_adv').change(function(){
        $('#cp').toggle(this.checked);
    }).change();
})
CUT
        );

        $form->addMagicSelect('exclude_coupon_batch_ids')
            ->setLabel(___('Do not calculate commission for invoice with coupon from these batches'))
            ->loadOptions($this->getDi()->couponBatchTable->getOptions());
    }

    function onHourly(Am_Event $e)
    {
        if ($this->getConfig('hourly_pending_remove')) {
            $q = $this->getDi()->db->queryResultOnly("SELECT u.*
                FROM ?_user u
                    LEFT JOIN ?_access a ON a.user_id = u.user_id
                    LEFT JOIN ?_invoice_payment ip ON ip.user_id = u.user_id
                WHERE u.status = 0
                    AND a.access_id IS NULL
                    AND ip.invoice_payment_id is NULL
                    AND u.added < ?
                GROUP BY u.user_id", sqlTime("- 10 minutes"));
            while ($r = $this->getDi()->db->fetchRow($q)) {
                $u = $this->getDi()->userTable->createRecord($r);
                $u->delete();
            }
        }
    }

    function onUserMenu(Am_Event $e)
    {
        $menu = $e->getMenu();
        $page = $menu->findById('aff');
        if ($page) {
            $page->addPage(array(
                'id' => 'aff-forced-matrix',
                'controller' => 'aff-forced-matrix',
                'label' => ___('Your Student Downline'),
            ));
        }
    }

    function onPaymentWithAccessAfterInsert(Am_Event $e)
    {
        /* @var $invoice Invoice */
        $invoice = $e->getInvoice();

        if (($coupon = $invoice->getCoupon()) &&
            in_array($coupon->batch_id, $this->getConfig('exclude_coupon_batch_ids'))) {
            return;
        }

        $user = $e->getUser();
        /* @var $payment InvoicePayment */
        $payment = $e->getPayment();
        if (!$user->aff_id)
            return; //initial customer

        $is_first_payment = $payment->isFirst();
        $product_ids = $this->getConfig('product_ids');

        $affiliate = $this->getDi()->userTable->load($user->aff_id);
        if ($affiliate->aff_id) {
            $sponsor = $this->getDi()->userTable->load($affiliate->aff_id, false);
        } else {
            $sponsor = null;
        }

        if ($this->getConfig('product_adv')) {
            $products = array();
            foreach ($affiliate->getActiveProductIds() as $pid) {
                $products = array_merge($products, $this->getConfig('product_' . $pid, array()));
            }
            if ($sponsor) {
                $sponsor_products = array();
                foreach ($sponsor->getActiveProductIds() as $pid) {
                    $sponsor_products = array_merge($sponsor_products, $this->getConfig('product_' . $pid, array()));
                }
            }
        } else {
            $products = array_keys($this->getDi()->productTable->getOptions());
            $sponsor_products = array_keys($this->getDi()->productTable->getOptions());
        }

        foreach ($invoice->getItems() as $item) {
            if (in_array($item->item_id, $products)) {
                $aff = $affiliate;
            } elseif (in_array($item->item_id, $sponsor_products)) {
                $aff = $sponsor;
            } else {
                continue;
            }
            if (!$aff)
                continue;

            if ($product_ids && !in_array($item->item_id, $product_ids))
                continue;
            if ($is_first_payment) {
                $comm = $this->getDi()->affCommissionRecord;
                $comm->date = sqlDate('now');
                $comm->record_type = AffCommission::COMMISSION;
                $comm->invoice_id = $invoice->invoice_id;
                $comm->invoice_item_id = $item->invoice_item_id;
                $comm->invoice_payment_id = $payment->pk();
                $comm->receipt_id = $payment->receipt_id;
                $comm->product_id = $item->item_id;
                $comm->is_first = 1;
                $comm->_setPayment($payment);
                $comm->_setInvoice($invoice);

                $product_comm = $this->getConfig('product_comm');
                $rate = $product_comm[$item->item_id] ?
                    $product_comm[$item->item_id] :
                    $this->getConfig('comm', 100);

                $comm->aff_id = $aff->pk();
                $comm->amount = ($payment->amount * $rate / 100);
                $comm->tier = 0;
                $comm->_setAff($aff);
                $comm->insert();
            } else {
                $aff_tier = $aff;
                $aff_tiers[0] = $aff_tier;
                $aff_tiers_exists[] = $aff_tier->pk();
                for ($tier = 1; $tier < count($this->tiers); $tier++) {
                    if (!$aff_tier->aff_id || ($aff_tier->pk() == $invoice->getUser()->pk()))
                        break;

                    $aff_tier = $this->getDi()->userTable->load($aff_tier->aff_id, false);
                    if (!$aff_tier || //not exists
                        !$aff_tier->is_affiliate || //not affiliate
                        ($aff_tier->pk() == $invoice->getUser()->pk()) || //original user
                        in_array($aff_tier->pk(), $aff_tiers_exists))  //already in chain
                        break;

                    $aff_tiers[$tier] = $aff_tier;
                    $aff_tiers_exists[] = $aff_tier->pk();
                }

                foreach ($aff_tiers as $tier => $aff) {
                    $comm = $this->getDi()->affCommissionRecord;
                    $comm->date = sqlDate('now');
                    $comm->record_type = AffCommission::COMMISSION;
                    $comm->invoice_id = $invoice->invoice_id;
                    $comm->invoice_item_id = $item->invoice_item_id;
                    $comm->invoice_payment_id = $payment->pk();
                    $comm->receipt_id = $payment->receipt_id;
                    $comm->product_id = $item->item_id;
                    $comm->is_first = 1;
                    $comm->_setPayment($payment);
                    $comm->_setInvoice($invoice);

                    $comm->aff_id = $aff->pk();
                    $comm->amount = $this->getCommAmount($payment, $tier);
                    $comm->tier = $tier;
                    $comm->_setAff($aff);
                    $comm->insert();
                }
            }
        }
    }

    function getCommAmount($payment, $tier)
    {

        switch ($this->getConfig('tiers_type_' . $tier, self::COMM_FIXED)) {
            case self::COMM_PERCENT :
                return $payment->amount * 0.01 * $this->getConfig('tiers_' . $tier);
            case self::COMM_FIXED :
            default:
                return $this->getConfig('tiers_' . $tier, $this->tiers[$tier]);
        }
    }

    function onUserAfterDelete(Am_Event $e)
    {
        $user = $e->getUser();
        $aff = $user;

        $chain = array();
        while ($aff = $this->getDi()->userTable->findFirstByAffId($aff->pk())) {
            array_push($chain, $aff);
        }

        $lastAff = null;
        while ($aff = array_pop($chain)) {
            $this->moveup($aff);
            $lastAff = $aff;
        }

        if ($lastAff && $user->aff_id) {
            $lastAff->aff_id = $user->aff_id;
            $lastAff->save();
        }
    }

    function onUserAfterInsert(Am_Event $e)
    {
        /* @var $user User */
        $user = $e->getUser();
        if ($user->is_affiliate && $user->aff_id)
            $this->sendNewStudentNotification($user);
    }

    function onUserAfterUpdate(Am_Event $e)
    {
        $user = $e->getUser();
        $oldUser = $e->getOldUser();
        if ($user->is_affiliate && $user->aff_id && ($user->aff_id != $oldUser->aff_id))
            $this->sendNewStudentNotification($user);
    }

    function sendNewStudentNotification(User $user)
    {
        if ($this->getConfig('notify_new_lead')) {
            $aff_id = $user->aff_id;
            $cnt = 0;
            while ($aff = $this->getDi()->userTable->load($aff_id, false)) {
                if (!$aff)
                    break;
                if (!$aff || (++$cnt > count($this->tiers)))
                    break;

                $et = Am_Mail_Template::load('misc.aff-forced-matrix.notify_new_lead', $aff->lang);
                $et->setUser($user);
                $et->setAffiliate($aff);
                $et->send($aff);

                if (!$aff->aff_id)
                    break;
                $aff_id = $aff->aff_id;
            }
        }
    }

    function moveup(User $user)
    {
        $this->getDi()->db->query("UPDATE ?_user SET aff_id=? WHERE aff_id=? AND user_id<>?", $user->pk(), $user->aff_id, $user->pk());
    }

}

class AffForcedMatrixController extends Am_Controller_Grid
{

    protected $layout = 'member/layout.phtml';
    protected $productOptions = array();

    public function init()
    {
        if ($p = $this->getDi()->plugins_misc->loadGet('aff-forced-matrix')->getConfig('priority', array())) {
            $op = array_combine($p, $p);
        } else {
            $op = array();
        }
        foreach ($this->getDi()->productTable->findBy() as $p) {
            $op[$p->pk()] = $p->title;
        }
        $this->productOptions = $op;
    }

    public function preDispatch()
    {
        $this->getDi()->auth->requireLogin(ROOT_URL . '/aff-forced-matrix');
        if (!$this->getDi()->user->is_affiliate)
            $this->_redirect('member');
        parent::preDispatch();
    }

    public function createGrid()
    {
        $g = new Am_Grid_ReadOnly('_sd', 'Your Student Downline', $this->getDs(), $this->getRequest(), $this->view);
        $g->addField('name', ___('Affiliate Name'))
            ->setGetFunction(array($this, 'getName'));
        $g->addField('product', ___('Membership Type'));
        $g->addField(new Am_Grid_Field_Date('added', ___('Date Join')))
            ->setFormatDate();
        $g->addField('level', ___('Matrix Level'));
        $g->addCallback(Am_Grid_ReadOnly::CB_RENDER_TABLE, array($this, 'renderTable'));
        return $g;
    }

    public function renderTable(& $out)
    {
        if ($s = $this->getSponsor()) {
            $out = sprintf('<div>Sponser: <strong>%s</strong></div><br />', $s->getName()) . $out;
        }
    }

    public function getName($r)
    {
        return $r->getName();
    }

    public function getSponsor()
    {
        $user = $this->getDi()->user;

        if ($user->aff_id) {
            return $this->getDi()->userTable->load($user->aff_id, false);
        }
    }

    public function getDs()
    {
        $user = $this->getDi()->user;

        if ($user->aff_id) {
            $sponsor = $this->getDi()->userTable->load($user->aff_id);
        }

        $students = array();
        $this->buildDownline($user, $students, 1);
        return new Am_Grid_DataSource_Array($students);
    }

    function buildDownline($user, & $students, $level)
    {
        if ($level > $this->getDi()->plugins_misc->loadGet('aff-forced-matrix')->getLevel())
            return;

        $items = $this->getDi()->userTable->findBy(array(
            'aff_id' => $user->pk(),
            'is_affiliate' => 1
            ));
        foreach ($items as $i) {
            $i->level = $level;
            $i->product = $this->getProduct($i);
            $students[] = $i;
            $this->buildDownline($i, $students, $level + 1);
        }
    }

    function getProduct(User $user)
    {
        $pr_ids = $user->getActiveProductIds();
        $pr_id = null;
        foreach ($this->productOptions as $k => $v) {
            if (in_array($k, $pr_ids)) {
                $pr_id = $k;
                break;
            }
        }
        return $pr_id ? $this->productOptions[$pr_id] : '';
    }

}

class AffCommissionRuleTableNull extends AffCommissionRuleTable
{

    public function findRules(Invoice $invoice, InvoiceItem $item, User $aff, $paymentNumber = 0, $tier = 0, $paymentDate = 'now')
    {
        return false;
    }

}

class Am_Form_Element_FirstCommission extends Am_Form_Element_MagicSelect
{

    function getValue()
    {
        return null;
    }

    protected function updateValue()
    {
        //nop
    }

}
