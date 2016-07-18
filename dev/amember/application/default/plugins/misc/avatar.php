<?php

/**
 * Plugin add new form brick "Avatar".
 * User can upload some picture here.
 *
 */

class Am_Plugin_Avatar extends Am_Plugin
{
    const PLUGIN_STATUS = self::STATUS_PRODUCTION;
    const PLUGIN_COMM = self::COMM_COMMERCIAL;
    const PLUGIN_REVISION = '4.4.4';

    const DEFAULT_WIDTH = 80;
    const DEFAULT_HEIGHT = 80;
    const UPLOAD_PREFIX = 'avatar';
    protected $_configPrefix = 'misc.';

    function init()
    {
        parent::init();
        $this->getDi()->uploadTable->defineUsage(self::UPLOAD_PREFIX,
            'user', 'avatar',
            UploadTable::STORE_FIELD, "User Avatar [%login%, %name_f% %name_l%]", '/admin-users?_u_a=edit&_u_id=%user_id%');
    }

    function _initSetupForm(Am_Form_Setup $form)
    {
        $form->setTitle(___('Avatar'));

        $group = $form->addGroup('')
            ->setLabel(___('Avatar Size') . "\n" . ___('width×height'));

        $group->addElement('text', 'width', array('size'=>4))
            ->setValue(self::DEFAULT_WIDTH);
        $group->addStatic('')->setContent(' &times; ');
        $group->addElement('text', 'height', array('size'=>4))
            ->setValue(self::DEFAULT_HEIGHT);

        $form->addUpload('default', null, array('prefix' => self::UPLOAD_PREFIX))
            ->setLabel(___('Default Avatar'));
    }

    function directAction(Am_Request $request, Zend_Controller_Response_Http $response, array $invokeArgs)
    {
        while (@ob_end_clean());
        Zend_Session::writeClose();

        $height = $this->getConfig('height', self::DEFAULT_HEIGHT);
        $width = $this->getConfig('width', self::DEFAULT_WIDTH);
        $id = $request->getActionName(); //actualy it is upload_id
        $id = ($id == 'index') ? $this->getConfig('default') : $id;

        /* @var $upload Upload */
        $upload = $this->getDi()->uploadTable->load($id);
        if ($upload->prefix != self::UPLOAD_PREFIX)
            throw new Am_Exception_InputError(sprintf('Incorrect prefix requested [%s]', $upload->prefix));

        $filename = ROOT_DIR . '/data/avatar/' . $width . '_' . $height . '/' . floor($id / 100) . '/' . $id . '.jpeg';

        if (!file_exists($filename))
        {
            while (!is_dir(dirname($filename)))
            {
                mkdir(dirname($filename), 0777, true);
            }

            $image = new Am_Image($upload->getFullPath(),  $upload->getType());
            $image->resize($width, $height)->save($filename);
        }

        header('Content-Type: image/jpeg');
        readfile($filename);
        exit;

    }

    function onGetUploadPrefixList(Am_Event $event)
    {
        $event->addReturn(array(
            Am_Upload_Acl::IDENTITY_TYPE_ADMIN => Am_Upload_Acl::ACCESS_ALL,
            Am_Upload_Acl::IDENTITY_TYPE_USER => Am_Upload_Acl::ACCESS_ALL,
            Am_Upload_Acl::IDENTITY_TYPE_ANONYMOUS => Am_Upload_Acl::ACCESS_ALL
        ), self::UPLOAD_PREFIX);
    }

    function onGridUserInitForm(Am_Event $event)
    {
        $upload = $event->getGrid()->getForm()->addUpload('avatar', null, array('prefix'=>self::UPLOAD_PREFIX))
            ->setLabel(___('Avatar'))
            ->setAllowedMimeTypes(array(
                'image/jpeg','image/gif','image/png'
            ))
            ->setJsOptions(<<<CUT
{
   fileBrowser:false,
   onFileDraw: function(info) {
     var \$div = $('<div class="avatar"><img src="' + window.rootUrl + '/misc/avatar/' + info.upload_id + '" /></div>');
     $(this).before(\$div);
     this.data('avatar-preview-conteiner', \$div);
   },
   onChange: function(count) {
      var avatar;
      if (count == 0 && (avatar = this.data('avatar-preview-conteiner'))) {
        avatar.remove();
        this.data('avatar-preview-conteiner', false);
      }

   }
}
CUT
                );
    }

    public static function activate($id, $pluginType)
    {
        try {
            Am_Di::getInstance()->db->query("ALTER TABLE ?_user ADD COLUMN avatar int null");
        } catch (Exception $e) {
            //nop
        }

    }

    public function onLoadBricks($event)
    {
        $fp = fopen(__FILE__, 'r');
        if (defined('__COMPILER_HALT_OFFSET__')) {
            fseek($fp, __COMPILER_HALT_OFFSET__);
            eval(stream_get_contents($fp));
        } else {
            eval(strstr(stream_get_contents($fp), 'class Am_Form' . '_Brick_'));
        }
        fclose($fp);
    }
}

__halt_compiler();

class Am_Form_Brick_Avatar extends Am_Form_Brick
{
    protected $labels = array(
        'Avatar' => 'Avatar',
    );

    protected $hideIfLoggedInPossible = self::HIDE_DESIRED;

    public function __construct($id = null, $config = null)
    {
        $this->name = ___('Avatar');
        parent::__construct($id, $config);
    }

    public function isAcceptableForForm(Am_Form_Bricked $form) {
        return true;
    }

    public function insertBrick(HTML_QuickForm2_Container $form)
    {
        $form->addUpload('avatar', null, array('prefix'=>Am_Plugin_Avatar::UPLOAD_PREFIX))
            ->setLabel($this->___('Avatar'))
            ->setAllowedMimeTypes(array(
                'image/jpeg','image/gif','image/png'
            ))
            ->setJsOptions(<<<CUT
{
   fileBrowser:false,
   onFileDraw: function(info) {
     var \$div = $('<div class="avatar"><img src="' + window.rootUrl + '/misc/avatar/' + info.upload_id + '" /></div>');
     $(this).before(\$div);
     this.data('avatar-preview-conteiner', \$div);
   },
   onChange: function(count) {
      var avatar;
      if (count == 0 && (avatar = this.data('avatar-preview-conteiner'))) {
        avatar.remove();
        this.data('avatar-preview-conteiner', false);
      }

   },
   urlUpload : '/upload/upload',
   urlGet : '/upload/get'
}
CUT
                );
    }
}