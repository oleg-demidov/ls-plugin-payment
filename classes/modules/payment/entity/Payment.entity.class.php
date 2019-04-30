<?php

class PluginPayment_ModulePayment_EntityPayment extends EntityORM
{
    
    protected $aRelations = array(
        'bills' => array( self::RELATION_TYPE_HAS_MANY, 'PluginPayment_ModulePayment_EntityBill', 'payment_id' )
    );
    
    protected $aValidateRules = [
        ['bills', 'bills', 'on' => ['currency', 'bills', '']],
        ['bills', 'currency', 'on' => ['currency', '']]
    ];
    
    public function addBill(PluginPayment_ModulePayment_EntityBill $oBill) {
        $this->aData['bills'][] = $oBill;
        return $this;
    }
    
    public function ValidateBills($aBills) {
        
        foreach ($aBills as $oBill) {
            if(!($oBill instanceof PluginPayment_ModulePayment_EntityBill)){
                return $this->Lang_Get('common.error');
            }
        }
        
        return true;
    }
    
    public function ValidateCurrency($aBills) {
        $sCurrency = current($aBills->getCurrency());        
        
        foreach ($aBills as $oBill) {
            if($oBill->getCurrency() != $sCurrency){
                return $this->Lang_Get('plugin.payment.notice.error_currency_not_valid');
            }
        }
        
        return true;        
    }
    
    public function getPrice() {
        $iPrice = 0;
        
        foreach ($this->getBills() as $oBill) {
            if($oBill->isPaid()){
                continue;
            }
            $iPrice += $oBill->getPrice();
        }
        
        parent::setPrice($iPrice);
        
        return parent::getPrice();
    }
    
    public function getUrlRedirect() {
        
    }
    
}