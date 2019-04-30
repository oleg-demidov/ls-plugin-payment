<?php

class PluginPayment_ModulePayment extends ModuleORM
{
    
    private $aProviders = [
        'robokassa'
    ];
    
    public function Init() {
        parent::Init(); 
    }
    
    public function CreateBill($iUserId, $fPrice, $sDescription, $sCallback, $aParams) {
        $oBill = Engine::GetEntity('PluginPayment_Payment_Bill', [
            'user_id' => $iUserId,
            'price' => $fPrice,
            'description' => $sDescription,
            'callback' => $sCallback,
            'params' => $aParams
        ]);
        
        if(!$oBill->_Validate()){
            return $oBill->_getValidateError();
        }
        
        return $oBill;
    }
    
    public function GetProvider($sCode) {
        if(!in_array($sCode, $this->aProviders)){
            return null;
        }
        
        return Engine::GetEntity('PluginPayment_Payment_Provider'. ucfirst($sCode));
    }
}