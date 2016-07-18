<?php

class Am_Plugin_LoginViaIp extends Am_Plugin
{
    const PLUGIN_STATUS = self::STATUS_BETA;
    const PLUGIN_REVISION = '@@VERSION@@';
    protected $_configPrefix = 'misc.';

    public static function activate($id, $pluginType)
    {
        // fix old version
        Am_Di::getInstance()->db->query("
            DROP TABLE IF EXISTS ?_store_user_ipaddress
        ");
        Am_Di::getInstance()->db->query("
            DROP TABLE IF EXISTS ?_login_via_ip
        ");
        Am_Di::getInstance()->db->query("
            CREATE TABLE ?_login_via_ip (
                user_id int(10) unsigned NOT NULL,
                ip_start int unsigned NOT NULL,
                ip_stop int unsigned NOT NULL
            ) CHARACTER SET utf8 COLLATE utf8_general_ci
        ");

        $data = Am_Di::getInstance()->db->selectCol("
            SELECT id as ARRAY_KEY, value
            FROM ?_data
            WHERE
            `table` = ?
            AND `key` = ?
        ", 'user', 'ip_addresses');
        if (empty($data))
            return;

        foreach ($data as $userId => $ipOrRanges) {
            $res = self::updateIPs($userId, $ipOrRanges, 0, false);
            if ($res)
                Am_Di::getInstance()->errorLogTable->log("[Activating login-via-ip plugin error]: userId# $userId, $res");
        }
    }

    protected static function updateIPs($userId, $ipOrRanges, $limitIps = 0, $deleted = true)
    {
        $ips = array();
        $cntIPs = 0;
        foreach (explode(',', $ipOrRanges) as $ipOrRange) {
            if (!$ipOrRange)
                continue;
            @list($fIP, $lIP) = explode('-', $ipOrRange);
            if (!$lIP)
                $lIP = $fIP;
            $numFIP = self::ip2number($fIP);
            $numLIP = self::ip2number($lIP);
            if ($numFIP > $numLIP)
                return "Bad IP Rage: start IP $fIP cannot bigger than end IP $lIP";

            $cntIPs += $numLIP - $numFIP + 1;
            $ips[] = array(
                'ip_range' => "$fIP-$lIP",
                'ip_start' => $numFIP,
                'ip_stop' => $numLIP,
            );
        }

        if (empty($ips))
            return;

        if ($limitIps && $cntIPs > $limitIps)
            return "Limit is exceeded: setted addresses " . $cntIPs . ", maximum $limitIps";

        if ($deleted)
            Am_Di::getInstance()->db->query("
                DELETE FROM ?_login_via_ip
                WHERE user_id = ?d
            ", $userId);

        $sql = array();
        foreach ($ips as $ip) {
            if ($uid = Am_Di::getInstance()->db->selectCell("
                SELECT user_id
                FROM ?_login_via_ip
                WHERE
                    (ip_start <= ? AND ip_stop >= ?)
                    OR (ip_start <= ? AND ip_stop >= ?)
            ", $ip['ip_start'], $ip['ip_start'], $ip['ip_stop'], $ip['ip_stop'])) {
                if ($uid == $userId)
                    continue;
                return "IP range {$ip['ip_range']} is used already at user #$uid [{$ip['ip_start']}-{$ip['ip_stop']}]";
            }


            $sql[] = "($userId, '{$ip["ip_start"]}', '{$ip["ip_stop"]}')";
        }

        Am_Di::getInstance()->db->query("
            INSERT INTO  ?_login_via_ip
                (user_id, ip_start, ip_stop)
            VALUES " . join(',', $sql));
    }

    protected static function ip2number($ip)
    {
        return sprintf("%u", ip2long($ip)); // fix for 32-bit system
    }

    public function _initSetupForm(Am_Form_Setup $form)
    {
        $form->setTitle(___('Login via IP'));
        $form->addInteger('limit_ip')
            ->setLabel(___("Global Limit of IP Addresses\nempty or 0 - without limit"));
        $form->addAdvCheckbox('disable_profile')
            ->setLabel(___("Disable Ability to Update Profile\nin case of user logged in via IP"));
    }

    public function init()
    {
        $this->getDi()->userTable->customFields()->add(
            new Am_CustomFieldText('limit_address', ___('Limit of IP Addresses'), ___(
                    "empty - use global setting\nif 0 - without limit"
                ), null, array('size' => 5))
        );
        $this->getDi()->userTable->customFields()->add(
            new Am_CustomFieldText('ip_addresses', ___('IP Address'), ___(
                    "separated by commas for several address, eg:\n" .
                    "12.12.12.12,23.23.23.23,34.34.34.34\n" .
                    "separated by hyphen for rage address, eg:\n" .
                    "123.123.123.1-123.123.123.100"
                ), null, array('size' => 60))
        );
        $this->getDi()->userTable->customFields()->add(new Am_CustomFieldCheckbox('login_via_ip', ___('Allow Login via IP Address'), null, array('id' => 'login_via_ip')));
    }

    function onGridUserInitForm(Am_Event_Grid $event)
    {
        $event->getGrid()->getForm()->addScript()
            ->setScript(<<<CUT
jQuery(function($){
    $('#row-limit_address-0').insertAfter($('#row-_signin_info-0'));
    $('#row-ip_addresses-0').insertAfter($('#row-_signin_info-0'));
    $('#row-login_via_ip-0').insertAfter($('#row-_signin_info-0'));
    $("#login_via_ip-0").change(function(){
        $("#row-ip_addresses-0").toggle(this.checked);
        $("#row-limit_address-0").toggle(this.checked);
    }).change();
});
CUT
        );
    }

    function onUserMenu(Am_Event $e)
    {
        if ($this->getConfig('disable_profile') && $this->isLoggedViaIp()) {
            $e->getMenu()->removePage($e->getMenu()->findOneBy('id', 'profile'));
        }
    }

    function onUserAfterUpdate(Am_Event_UserAfterUpdate $event)
    {
        $user = $event->getUser();
        if (!$user->data()->get('login_via_ip')) {
            $user->data()->set('ip_addresses', null);
            $user->data()->set('ip_addresses_save', null);
            $user->data()->set('limit_address', null);
            $user->data()->update();

            Am_Di::getInstance()->db->query("
                DELETE FROM ?_login_via_ip
                WHERE user_id = ?d
            ", $user->pk());
            return;
        }
        $newIPs = $user->data()->get('ip_addresses');
        $l = $user->data()->get('limit_address');
        $limit = (!is_null($l)) ? $l : $this->getConfig('limit_ip', 0);
        $res = self::updateIPs($user->pk(), $newIPs, $limit);
        if (!empty($res)) {
            $oldIPs = $user->data()->get('ip_addresses_save');
            $user->data()->set('ip_addresses', $oldIPs)->update();

            throw new Am_Exception_InputError($res);
        }

        $user->data()->set('ip_addresses_save', $newIPs)->update();
    }

    function onUserAfterDelete(Am_Event_UserAfterDelete $event)
    {
        $this->getDi()->db->query("
            DELETE FROM ?_login_via_ip
            WHERE user_id = ?d
        ", $event->getUser()->user_id);
    }

    function onAuthCheckLoggedIn(Am_Event_AuthCheckLoggedIn $event)
    {
        $numIP = self::ip2number($this->getDi()->request->getClientIp());
        $uId = $this->getDi()->db->selectCell("
            SELECT user_id
            FROM ?_login_via_ip
                WHERE
                    ip_start <= ? AND ip_stop >= ?
            ", $numIP, $numIP);

        if ($uId) {
            if ($user = $this->getDi()->userTable->load($uId, false)) {
                $this->setLoggedViaIp(true);
                $event->setSuccessAndStop($user);
            }
        }
    }

    function onAuthAfterLogout()
    {
        $this->setLoggedViaIp(false);
    }

    public function setLoggedViaIp($flag)
    {
        $session = new Zend_Session_Namespace('login-via-ip');
        $session->logged_via_ip = $flag;
    }

    public function isLoggedViaIp()
    {
        $session = new Zend_Session_Namespace('login-via-ip');
        return $session->logged_via_ip;
    }

    public function getReadme()
    {
        $o1 = ___('Allow Login via IP Address');
        $o2 = ___('IP Addresses');
        return <<<CUT
        Login via IP Address Plugin

This plugin allows to user automatic logs in to amember via IP address.

For it go to editing user data and check '$o1' option and added IP address/ranges at '$o2' field

CUT;
    }

    public function onInitFinished(Am_Event $e)
    {
        Zend_Controller_Front::getInstance()->registerPlugin(new Am_Controller_LoginViaIp($this), 500);
    }

}

class Am_Controller_LoginViaIp extends Zend_Controller_Plugin_Abstract
{

    protected $plugin;

    public function __construct(Am_Plugin $plugin)
    {
        $this->plugin = $plugin;
    }

    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        if (
            $this->plugin->getConfig('disable_profile') &&
            $this->plugin->isLoggedViaIp() &&
            $this->getRequest()->getControllerName() == 'profile') {

            throw new Am_Exception_AccessDenied('Access Denied');
        }
    }

}