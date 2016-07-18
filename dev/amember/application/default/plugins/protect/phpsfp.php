<?php

/**
 * @table integration
 * @id phpsfp
 * @title phpSFP
 * @visible_link phpSFP on Envato Market
 * @hidden_link http://codecanyon.net/item/phpsfp-schedule-facebook-posts/5177393
 * @different_groups 0
 * @single_login 1
 * @type Other..
 */
class Am_Protect_Phpsfp extends Am_Protect_Databased
{
    const PLUGIN_DATE = '$Date$';
    const PLUGIN_REVISION = '@@VERSION@@';

    const SESS_COOKIE_NAME = 'ci_session';

    protected $guessTablePattern = "users";
    protected $guessFieldsPattern = array(
        'name', 'email', 'username', 'password', 'access', 'status', 'timestamp',
    );
    protected $groupMode = Am_Protect_Databased::GROUP_SINGLE;

    public function getPasswordFormat()
    {
        return SavedPassTable::PASSWORD_SHA1;
    }

    public function parseExternalConfig($path)
    {
        $config_path = $path . "/config.php";
        if (!is_file($config_path) || !is_readable($config_path))
            throw new Am_Exception_InputError("Specified path is not a valid installation!");

        include_once $config_path;
        if (!defined('DB_NAME') || !DB_NAME)
            throw new Am_Exception_InputError("Specified path is not a valid installation!");

        $content = file_get_contents($path . "/application/config/config.php");
        preg_match("/\\$" . "config\['encryption_key']\s*=\s*'(.+?)'/im", $content, $m);

        return array(
            'db' => DB_NAME,
            'host' => DB_HOSTNAME,
            'user' => DB_USERNAME,
            'pass' => DB_PASSWORD,
            'prefix' => '',
            'encryption_key' => $m[1]
        );
    }

    public function afterAddConfigItems(Am_Form_Setup_ProtectDatabased $form)
    {
        parent::afterAddConfigItems($form);
        $form->addText('protect.phpsfp.encryption_key', array('class' => 'el-wide'))
            ->setLabel("Encryption Key\n" .
                "can be found in file phpsfp/application/config/config.php, " .
                "do not change default value unless you know what you do");
    }

    public function getLoggedInRecord()
    {
        if (($s = $this->getSession()) && isset($s['username'])) {
            if (($u = $this->decode($s['username'])) && $s['logged']) {
                return $this->getTable()->load($u, false);
            }
        }
    }

    public function loginUser(Am_Record $record, $password)
    {
        $s = $this->getSession();
        if (!$s)
            $s = array();

        $s['username'] = $this->encode($record->id);
        $s['access'] = $record->access;
        $s['logged'] = true;
        $this->saveSession($s);
    }

    public function logoutUser(User $user)
    {
        Am_Controller::setCookie(self::SESS_COOKIE_NAME, '', $this->getDi()->time - 3600, '/', $this->getDi()->request->getHttpHost());
    }

    public function createTable()
    {
        $table = new Am_Protect_Table_Phpsfp($this, $this->getDb(), '?_users', 'id');
        $table->setFieldsMapping(array(
            array(Am_Protect_Table::FIELD_NAME, 'name'),
            array(Am_Protect_Table::FIELD_EMAIL, 'email'),
            array(Am_Protect_Table::FIELD_LOGIN, 'username'),
            array(Am_Protect_Table::FIELD_PASS, 'password'),
            array(':0', 'access'),
            array(Am_Protect_Table::FIELD_GROUP_ID, 'status'),
            array(Am_Protect_Table::FIELD_ADDED_STAMP, 'timestamp'),
        ));

        return $table;
    }

    function getAvailableUserGroups()
    {
        $ret = array();

        $groups = array(
            array(
                'id' => 'not-activated',
                'title' => 'Not Activated',
                'isAdmin' => 0,
                'isBanned' => 0
            ),
            array(
                'id' => 'activated',
                'title' => 'Activated',
                'isAdmin' => 0,
                'isBanned' => 0
            )
        );

        foreach ($groups as $g) {
            $ret[] = new Am_Protect_Databased_Usergroup($g);
        }

        return $ret;
    }

    function saveSession($data)
    {
        $data['session_id'] = isset($data['session_id']) ? $data['session_id'] : md5(uniqid());
        $data['ip_address'] = isset($data['ip_address']) ? $data['ip_address'] : $_SERVER['REMOTE_ADDR'];
        $data['user_agent'] = isset($data['user_agent']) ? $data['user_agent'] : substr($_SERVER['HTTP_USER_AGENT'], 0, 120);
        $data['last_activity'] = $this->getDi()->time;

        $v = $this->_serialize($data);
        $v = $v . md5($v . $this->getConfig('encryption_key'));
        Am_Controller::setCookie(self::SESS_COOKIE_NAME, $v, 0, '/', $this->getDi()->request->getHttpHost());
    }

    function getSession()
    {
        if (!isset($_COOKIE[self::SESS_COOKIE_NAME]))
            return null;

        $s = $_COOKIE[self::SESS_COOKIE_NAME];
        $hash = substr($s, strlen($s) - 32);
        $s = substr($s, 0, strlen($s) - 32);

        if ($hash !== md5($s . $this->getConfig('encryption_key'))) {
            return null;
        }

        $data = $this->_unserialize($s);
        return $data;
    }

    function encode($string)
    {
        $key = md5($this->getConfig('encryption_key'));
        $enc = $this->mcrypt_encode($string, $key);
        return base64_encode($enc);
    }

    function decode($string, $key = '')
    {
        $key = md5($this->getConfig('encryption_key'));
        $dec = base64_decode($string);
        return $this->mcrypt_decode($dec, $key);
    }

    function mcrypt_encode($data, $key)
    {
        $init_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC);
        $init_vect = mcrypt_create_iv($init_size, MCRYPT_RAND);
        return $this->_add_cipher_noise($init_vect . mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $data, MCRYPT_MODE_CBC, $init_vect), $key);
    }

    function mcrypt_decode($data, $key)
    {
        $data = $this->_remove_cipher_noise($data, $key);
        $init_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC);

        if ($init_size > strlen($data)) {
            return false;
        }

        $init_vect = substr($data, 0, $init_size);
        $data = substr($data, $init_size);
        return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $data, MCRYPT_MODE_CBC, $init_vect), "\0");
    }

    function _serialize($data)
    {
        if (is_array($data)) {
            foreach ($data as $key => $val) {
                if (is_string($val)) {
                    $data[$key] = str_replace('\\', '{{slash}}', $val);
                }
            }
        } else {
            if (is_string($data)) {
                $data = str_replace('\\', '{{slash}}', $data);
            }
        }

        return serialize($data);
    }

    function _unserialize($data)
    {
        $data = @unserialize($data);

        if (is_array($data)) {
            foreach ($data as $key => $val) {
                if (is_string($val)) {
                    $data[$key] = str_replace('{{slash}}', '\\', $val);
                }
            }

            return $data;
        }

        return (is_string($data)) ? str_replace('{{slash}}', '\\', $data) : $data;
    }

    function _add_cipher_noise($data, $key)
    {
        $keyhash = sha1($key);
        $keylen = strlen($keyhash);
        $str = '';

        for ($i = 0, $j = 0, $len = strlen($data); $i < $len; ++$i, ++$j) {
            if ($j >= $keylen) {
                $j = 0;
            }

            $str .= chr((ord($data[$i]) + ord($keyhash[$j])) % 256);
        }

        return $str;
    }

    function _remove_cipher_noise($data, $key)
    {
        $keyhash = sha1($key);
        $keylen = strlen($keyhash);
        $str = '';

        for ($i = 0, $j = 0, $len = strlen($data); $i < $len; ++$i, ++$j) {
            if ($j >= $keylen) {
                $j = 0;
            }

            $temp = ord($data[$i]) - ord($keyhash[$j]);

            if ($temp < 0) {
                $temp = $temp + 256;
            }

            $str .= chr($temp);
        }

        return $str;
    }
    
    function getReadme()
    {
        preg_match('#://(.*?)/#i', ROOT_URL, $m);
        $d = '.' . Am_License::getMinDomain($m[1]);
        return <<<CUT
In case you use phpSFP on subdomain of domain where amember is installed then please edit file
phpsfp/application/config/config.php
find line
<strong>\$config['cookie_domain'] = "";</strong>
and replace it with
<strong>\$config['cookie_domain'] = "$d";</strong>
CUT;
    }

}

class Am_Protect_Table_Phpsfp extends Am_Protect_Table
{

    protected $g_map = array(
        0 => 'not-activated',
        1 => 'activated'
    );
    protected $g_map_r = null;

    public function __construct(Am_Protect_Databased $plugin, $db = null, $table = null, $recordClass = null, $key = null)
    {
        parent::__construct($plugin, $db, $table, $recordClass, $key);
        $this->g_map_r = array_combine($this->g_map, array_keys($this->g_map));
    }

    public function setGroups(Am_Record $record, $groups)
    {
        $record->status = $this->g_map_r[$groups];
        $record->save();
    }

    function getGroups(Am_Record $record)
    {
        return $this->g_map[$record->status];
    }

}