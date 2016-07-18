<?php

class Am_Plugin_AffReferredBy extends Am_Plugin
{
    public function onLoadBricks($event)
    {
        $fp = fopen(__FILE__, 'r');
        if (defined('__COMPILER_HALT_OFFSET__')) {
            fseek($fp, __COMPILER_HALT_OFFSET__);
            eval(stream_get_contents($fp));
        }
        else {
            eval(strstr(stream_get_contents($fp), 'class Am_Form' . '_Brick_'));
        }
        fclose($fp);
    }
}

__halt_compiler();

class Am_Form_Brick_AffReferredBy extends Am_Form_Brick
{

    protected $labels = array(
        "Affiliate Referral"
    );

    public function insertBrick(HTML_QuickForm2_Container $form)
    {
        $di = Am_Di::getInstance();
        if ($di->auth->getUserId()) return;
        
        $aff_id = $di->modules->get('aff')->findAffId();
        if (!$aff_id) return;
        
        $aff = $di->userTable->load($aff_id);
        
        $form->addStatic()
            ->setLabel($this->___('Affiliate Referral'))
            ->setContent($aff->getName());
    }

    public function isMultiple()
    {
        return false;
    }
}