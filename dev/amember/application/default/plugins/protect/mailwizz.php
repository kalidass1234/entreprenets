<?php

/**
 * @table integration
 * @id mailwizz
 * @title Mailwizz
 * @visible_link http://www.mailwizz.com/
 * @different_groups 1
 * @single_login 1
 * @type Email Systems/AutoResponders
 */
class Am_Protect_Mailwizz extends Am_Protect_Databased
{
    const PLUGIN_DATE = '$Date$';
    const PLUGIN_REVISION = '@@VERSION@@';

    protected $guessTablePattern = "customer";
    protected $guessFieldsPattern = array(
        'customer_uid', 'group_id', 'first_name', 'last_name', 'email', 'password', 'removable', 'status', 'date_added',
    );
    protected $groupMode = Am_Protect_Databased::GROUP_SINGLE;

    public function parseExternalConfig($path)
    {
        $config_path = $path . "/apps/common/config/main-custom.php";
        if (!is_file($config_path) || !is_readable($config_path))
            throw new Am_Exception_InputError("Specified path is not a valid installation!");

        define('MW_PATH', '');
        $config = include_once $config_path;

        if (!isset($config) || !isset($config['components']['db']))
            throw new Am_Exception_InputError("Specified path is not a valid installation!");

        $c = array(
            'user' => $config['components']['db']['username'],
            'pass' => $config['components']['db']['password'],
            'prefix' => $config['components']['db']['tablePrefix']
        );

        if (preg_match('/host=(.*?)(;|$)/', $config['components']['db']['connectionString'], $m)) {
            $c['host'] = $m[1];
        }
        if (preg_match('/dbname=(.*?)(;|$)/', $config['components']['db']['connectionString'], $m)) {
            $c['db'] = $m[1];
        }

        return $c;
    }

    public function getPasswordFormat()
    {
        return SavedPassTable::PASSWORD_PHPASS;
    }

    public function createTable()
    {
        $table = new Am_Protect_Table($this, $this->getDb(), '?_customer', 'customer_id');
        $table->setFieldsMapping(array(
            array(array($this, 'getUid'), 'customer_uid'),
            array(Am_Protect_Table::FIELD_GROUP_ID, 'group_id'),
            array(Am_Protect_Table::FIELD_NAME_F, 'first_name'),
            array(Am_Protect_Table::FIELD_NAME_L, 'last_name'),
            array(Am_Protect_Table::FIELD_EMAIL, 'email'),
            array(Am_Protect_Table::FIELD_PASS, 'password'),
            array(':yes', 'removable'),
            array(':active', 'status'),
            array(Am_Protect_Table::FIELD_ADDED_SQL, 'date_added'),
            array(Am_Protect_Table::FIELD_ADDED_SQL, 'last_updated'),
        ));

        return $table;
    }

    public function getUid($user, $record)
    {
        return (isset($record->customer_uid) && $record->customer_uid) ?
            $record->customer_uid :
            substr(md5(uniqid()),0,13);
    }

    public function getAvailableUserGroupsSql()
    {
        return "SELECT
            group_id as id,
            name as title,
            NULL as is_banned,
            NULL as is_admin
            FROM ?_customer_group";
    }

    public function createSessionTable()
    {
        $table = new Am_Protect_SessionTable_Mailwizz(
                $this, $this->getDb(),
                '?_session', 'id');
        $table->setTableConfig(array(
            Am_Protect_SessionTable::FIELD_SID => 'id',
            Am_Protect_SessionTable::FIELD_UID => '_', //ignore it @see Am_Protect_SessionTable_Mailwizz
            Am_Protect_SessionTable::SESSION_COOKIE => 'mwsid',
            Am_Protect_SessionTable::FIELDS_ADDITIONAL => array(
                'expire' => array($this, 'getExpire')
            ),
            Am_Protect_SessionTable::COOKIE_PARAMS => array(
                'domain' => $this->getDi()->request->getHttpHost()
            )
            )
        );
        return $table;
    }

    function getExpire($user, $session)
    {
        return $this->getDi()->time + ini_get('session.gc_maxlifetime');
    }

    function getVarName($name)
    {
        return md5('Yii.WebCustomer.MailWizz') . '__' . $name;
    }

    public function getReadme()
    {
        return <<<CUT
You need to disable Customer Registration on Mailwizz
Settings -> Customers -> Registration (Enabled)
CUT;
    }

}

class Am_Protect_SessionTable_Mailwizz extends Am_Protect_SessionTable
{

    function sessionIsValid(Am_Record $session)
    {
        return parent::sessionIsValid($session) && ($session->expire > $this->getDi()->time);
    }

    function getUid(Am_Protect_SessionTable_Record $record)
    {
        $s = $_SESSION;
        $_SESSION = array();
        session_decode($record->data);
        $name = $this->_plugin->getVarName('id');
        $uid = isset($_SESSION[$name]) ? $_SESSION[$name] : null;
        //restore original session
        $_SESSION = $s;
        return $uid;
    }

    function setUid(Am_Protect_SessionTable_Record $record, Am_Record $user)
    {
        $s = $_SESSION;
        $_SESSION = array();
        session_decode($record->data);
        $_SESSION[$this->_plugin->getVarName('id')] = $user->pk();
        $_SESSION[$this->_plugin->getVarName('name')] = $user->email;
        $record->data = session_encode();
        //restore original session
        $_SESSION = $s;
    }

}