<?php

class Am_Protect_Projectbox extends Am_Protect_Databased
{
    const PLUGIN_DATE = '$Date$';
    const PLUGIN_REVISION = '@@VERSION@@';

    const GROUP_BANNED = '-1';

    protected $guessTablePattern = "users";
    protected $guessFieldsPattern = array(
        'username', 'email', 'password', 'IP', 'access_level', 'avatar', 'first_name', 'last_name', 'email_noti', 'week_hours', 'active_groupid', 'task_noti', 'default_cat', 'points',
    );
    protected $groupMode = Am_Protect_Databased::GROUP_SINGLE;

    public function getPasswordFormat()
    {
        return SavedPassTable::PASSWORD_PHPASS;
    }

    public function parseExternalConfig($path)
    {
        $config_path = $path . "/application/config/database.php";
        if (!is_file($config_path) || !is_readable($config_path))
            throw new Am_Exception_InputError("Specified path is not a valid installation!");

        $content = file_get_contents($config_path);
        preg_match("/\\$" . "db\['default']\['hostname']\s*=\s*'(.+?)'/im", $content, $h);
        preg_match("/\\$" . "db\['default']\['username']\s*=\s*'(.+?)'/im", $content, $u);
        preg_match("/\\$" . "db\['default']\['password']\s*=\s*'(.+?)'/im", $content, $p);
        preg_match("/\\$" . "db\['default']\['database']\s*=\s*'(.+?)'/im", $content, $d);
        preg_match("/\\$" . "db\['default']\['dbprefix']\s*=\s*'(.+?)'/im", $content, $dp);

        return array(
            'db' => $d[1],
            'host' => $h[1],
            'user' => $u[1],
            'pass' => $p[1],
            'prefix' => $dp[1]
        );
    }

    public function getLoggedInRecord()
    {
        if (isset($_COOKIE['pbun']) && isset($_COOKIE['pbtkn']) && ($u = $this->getTable()->findFirstByEmail($_COOKIE['pbun']))) {
            if ($u->token && $u->token == $_COOKIE['pbtkn'])
                return $u;
        }
    }

    public function loginUser(Am_Record $record, $password)
    {
        $token = $this->getDi()->app->generateRandomString(255);
        $record->updateQuick('token', $token);

        Am_Controller::setCookie('pbun', $record->email, 0, '/', $this->getDi()->request->getHttpHost());
        Am_Controller::setCookie('pbtkn', $token, 0, '/', $this->getDi()->request->getHttpHost());
    }

    public function logoutUser(User $user)
    {
        Am_Controller::setCookie('pbun', '', $this->getDi()->time - 3600, '/', $this->getDi()->request->getHttpHost());
        Am_Controller::setCookie('pbtkn', '', $this->getDi()->time - 3600, '/', $this->getDi()->request->getHttpHost());
    }

    public function createTable()
    {
        $table = new Am_Protect_Table_Projectbox($this, $this->getDb(), '?_users', 'ID');
        $table->setFieldsMapping(array(
            array(Am_Protect_Table::FIELD_LOGIN, 'username'),
            array(Am_Protect_Table::FIELD_EMAIL, 'email'),
            array(Am_Protect_Table::FIELD_PASS, 'password'),
            array(Am_Protect_Table::FIELD_REMOTE_ADDR, 'IP'),
            array(Am_Protect_Table::FIELD_GROUP_ID, 'access_level'),
            array(':guest.png', 'avatar'),
            array(Am_Protect_Table::FIELD_NAME_F, 'first_name'),
            array(Am_Protect_Table::FIELD_NAME_L, 'last_name'),
            array(':1', 'email_noti'),
            array(':0', 'week_hours'),
            array(':0', 'active_groupid'),
            array(':1', 'task_noti'),
            array(':0', 'default_cat'),
            array(':0', 'points'),
        ));

        return $table;
    }

    function getAvailableUserGroups()
    {
        $ret = array();

        foreach (array(
        '-1' => 'Banned',
        '1' => 'Member',
        '2' => 'Project Creator',
        '4' => 'Admin'
        ) as $id => $title) {
            $g = new Am_Protect_Databased_Usergroup(array(
                    'id' => $id,
                    'title' => $title,
                    'is_admin' => $id == '4',
                    'is_banned' => $id == '-1'
                ));
            $ret[$g->getId()] = $g;
        }
        return $ret;
    }

}

class Am_Protect_Table_Projectbox extends Am_Protect_Table
{

    function getGroups(Am_Record $record)
    {
        $g = parent::getGroups($record);
        if ($g == 0)
            $g = Am_Protect_ProjectBox::GROUP_BANNED;
        return $g;
    }

    function setGroups(Am_Record $record, $groups)
    {
        if ($groups == Am_Protect_ProjectBox::GROUP_BANNED)
            $groups = 0;
        return parent::setGroups($record, $groups);
    }

}