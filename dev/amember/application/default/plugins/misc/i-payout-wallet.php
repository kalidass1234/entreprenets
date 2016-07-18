<?php

/**
 * set up ewallet for customer after first
 * completed payment
 *
 */
class Am_Plugin_IPayoutWallet extends Am_Plugin
{
    const PLUGIN_STATUS = self::STATUS_BETA;
    const PLUGIN_COMM = self::COMM_COMMERCIAL;
    const PLUGIN_REVISION = '@@VERSION@@';
    const DATA_KEY = 'ips-id';

    protected $_configPrefix = 'misc.';

    function _initSetupForm(Am_Form_Setup $form)
    {
        $form->addText('merchant', array('class' => 'el-wide'))->setLabel('Merchant Name');
        $form->addText('MerchantGUID', array('class' => 'el-wide'))->setLabel('API Merchant ID');
        $form->addPassword('MerchantPassword')->setLabel('API Merchant Password');
        $form->addAdvCheckbox('testing')
            ->setLabel("Is it a Sandbox(Testing) Account?");
    }
    
    public function isConfigured()
    {
        return $this->getConfig('MerchantGUID') && $this->getConfig('MerchantPassword');
    }

    public function onPaymentAfterInsert(Am_Event $e)
    {
        $user = $e->getPayment()->getUser();

        if (!$user->data()->get(self::DATA_KEY)) {
            //create user
            $req = new Am_HttpRequest($this->url(), Am_HttpRequest::METHOD_POST);
            $req->addPostParameter(array(
                'fn' => 'eWallet_RegisterUser',
                'MerchantGUID' => $this->getConfig('MerchantGUID'),
                'MerchantPassword' => $this->getConfig('MerchantPassword'),
                'UserName' => $user->login,
                'FirstName' => $user->name_f,
                'LastName' => $user->name_l,
                'EmailAddress' => $user->email,
                'DateOfBirth' => '1/1/1900' //unknown
            ));

            $log = $this->getDi()->invoiceLogRecord;
            $log->user_id = $user->pk();
            $log->add($req);
            
            $resp = $req->send();
            $log->add($resp);

            if ($resp->getStatus() != 200) {
                $this->getDi()->errorLogTable->log('i-payout-wallet: Incorrect HTTP response status: ' . $resp->getStatus());
                return;
            }

            parse_str($resp->getBody(), $tmp);
            parse_str($tmp['response'], $params);

            if ($params['m_Code'] != 'NO_ERROR') {
                $this->getDi()->errorLogTable->log('i-payout-wallet: ' . $params['m_Text']);
                return;
            }

            $user->data()->set(self::DATA_KEY, $params['TransactionRefID'])->update();
        }
    }

    function url()
    {
        return $this->getConfig('testing') ?
            'https://www.testewallet.com/eWalletWS/ws_Adapter.aspx' :
            'https://www.i-payout.net/eWalletWS/ws_Adapter.aspx';
    }

}