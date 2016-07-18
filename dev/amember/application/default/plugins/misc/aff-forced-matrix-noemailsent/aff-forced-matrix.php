<?php

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
    const MATRIX_WIDTH = 3;
    const ORIG_AFF_ID = 'orig_aff_id';

    protected $_configPrefix = 'misc.';
    protected $tiers = array(
        0 => 8,
        1 => 4,
        2 => 3,
        3 => 4,
        4 => 4,
        5 => 5,
        6 => 6
    );

    public function _initSetupForm(Am_Form_Setup $form)
    {
        $form->setTitle(___('Forced Matrix'));

        $form->addText('comm')
            ->setLabel(___('Commission for first Payment, %'))
            ->default = 100;

        for ($i = 0; $i < count($this->tiers); $i++) {
            $form->addText('tiers_' . $i)
                    ->setLabel(sprintf('Commission [Tier %d], $', $i + 1))
                ->default = $this->tiers[$i];
        }

        $form->addAdvCheckbox('hourly_pending_remove')
            ->setLabel(___('Remove Pending Users Hourly'));
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

    function onPaymentAfterInsert(Am_Event $e)
    {
        /* @var $invoice Invoice */
        $invoice = $e->getInvoice();
        $user = $e->getUser();
        $payment = $e->getPayment();
        if (!$user->aff_id)
            return; //initial customer

        $is_first_payment = $this->getDi()->invoicePaymentTable->countByUserId($user->pk()) == 1;

        foreach ($invoice->getItems() as $item) {
            if ($is_first_payment) {
                $aff_id = $user->data()->get(self::ORIG_AFF_ID);
                if (!$aff_id) { //organic signup
                    $master = $this->findMasterAff($user);
                    $aff_id = $master->pk();
                }
                $aff = $this->getDi()->userTable->load($aff_id);

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
                $comm->amount = ($payment->amount * $this->getConfig('comm', 100) / 100);
                $comm->tier = 0;
                $comm->_setAff($aff);
                $comm->insert();
            } else {
                $aff_tier = $this->getDi()->userTable->load($user->aff_id);
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
                    $comm->amount = $this->getConfig('tiers_' . $tier, $this->tiers[$tier]);
                    $comm->tier = $tier;
                    $comm->_setAff($aff);
                    $comm->insert();
                }
            }
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

    function moveup(User $user)
    {
        $this->getDi()->db->query("UPDATE ?_user SET aff_id=? WHERE aff_id=? AND user_id<>?", $user->pk(), $user->aff_id, $user->pk());
    }

    function onAffBindAffiliate(Am_Event $e)
    {
        $aff_id = $e->getReturn();
        $user = $e->getUser();
        if ($aff_id) {
            $aff = $this->getDi()->userTable->load($aff_id);
            $users = array($aff);
            $user->data()->set(self::ORIG_AFF_ID, $aff_id);
        } else {
            $users = $this->getDi()->userTable->findByAffId(null);
            if (!$users) return; //master affiliate
        }
        $a = $this->findNextPosition($users);

        $e->setReturn($a->pk());
    }


    function findMasterAff($user)
    {
        while($user->aff_id) {
            $user = $this->getDi()->userTable->load($user->aff_id);
        }
        return $user;
    }

    /**
     *
     * @param User[] $users
     * @return User
     */
    function findNextPosition($users)
    {
        $nextTry = array();
        foreach ($users as $user) {
            $items = $this->getDi()->userTable->findByAffId($user->pk());
            if (count($items) < self::MATRIX_WIDTH)
                return $user;
            $nextTry = array_merge($nextTry, $items);
        }
        return $this->findNextPosition($nextTry);
    }

}

class AffForcedMatrixController extends Am_Controller
{
    protected $productOptions = array();

    public function init()
    {
        foreach($this->getDi()->productTable->findBy() as $p) {
            $this->productOptions[$p->pk()] = $p->title;
        }
    }

    public function preDispatch()
    {
        $this->getDi()->auth->requireLogin(ROOT_URL . '/aff-forced-matrix');
        if (!$this->getDi()->user->is_affiliate)
            $this->_redirect('member');
        parent::preDispatch();
    }

    public function indexAction()
    {
        $this->view->headScript()->prependFile(REL_ROOT_URL . '/application/default/plugins/misc/aff-forced-matrix/public/js/ftiens4.js');
        $this->view->headScript()->prependFile(REL_ROOT_URL . '/application/default/plugins/misc/aff-forced-matrix/public/js/ua.js');
        $user = $this->getDi()->user;
        $this->buildTree($user);



        if ($user->aff_id) {
            $parent = $this->getDi()->userTable->load($user->aff_id);
            $parent->children = array($user);
            $user = $parent;
        }

        $path = REL_ROOT_URL . '/application/default/plugins/misc/aff-forced-matrix/public/img/';

        $node = $this->renderNodes($user);
        $correlation = $this->renderCorrelations($user);
        $tree = $this->renderTree($user);

        $this->view->content = <<<CUT
<style type="text/css">
    .am-body-content img {max-width: none!important}
</style>
<a style="display: none;" href="http://www.treemenu.net/" target=_blank>Javascript Tree Menu</a>
<script type="text/javascript">
    ICONPATH = '$path';
    USEICONS = 0;
    USETEXTLINKS = 0;
    STARTALLOPEN = 0;
    HIGHLIGHT = 0;
    PRESERVESTATE = 0;
    GLOBALTARGET = 'T';
    BUILDALL = 1;
    USEFRAMES = 0;

    $node
    $correlation
    $tree

    initializeDocument();
</script>
<div id="forced-matrix"></div>
CUT;
        $this->view->display('member/layout.phtml');
    }

    function buildTree(User $user) {
        $items = $this->getDi()->userTable->findByAffId($user->pk());
        foreach ($items as $i) {
            $this->buildTree($i);
        }
        $user->children = $items;
    }

    function renderTree(User $user)
    {
        return sprintf('foldersTree = node%d;
', $user->pk());
    }

    function renderCorrelations(User $user)
    {
       $data = array();
       $out = '';
       foreach ($user->children as $u)
       {
           $out .= $this->renderCorrelations($u);
           $data[] = sprintf('node%d', $u->pk());
       }

       $out .= sprintf('node%d.addChildren([%s]);
', $user->pk(), implode(',', $data));
       return $out;
    }

    function renderNodes(User $user)
    {
        $out = $this->renderNode($user);
        foreach ($user->children as $u) {
            $out .= $this->renderNodes($u);
        }
        return $out;
    }

    function renderNode(User $user)
    {
        @list($pr_id) = $user->getActiveProductIds();
        $title = $user->getName() . ($pr_id ? ' - ' . $this->productOptions[$pr_id] : '');

        return sprintf('node%d = gFld("%s", "javascript:;");
node%1$d.xID = "%1$d";
', $user->pk(), $title);
    }
}