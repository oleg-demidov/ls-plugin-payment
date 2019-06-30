<?php

class PluginPayment_ModulePayment extends ModuleORM
{
    
    private $aProviders = [
        'robokassa'
    ];
    
    public function Init() {
        parent::Init(); 
    }
    
   
    public function GetProvider($sCode) {
        if(!in_array($sCode, $this->aProviders)){
            return null;
        }
        
        return Engine::GetEntity('PluginPayment_Payment_Provider'. ucfirst($sCode));
    }
}