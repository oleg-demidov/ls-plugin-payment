<?php

class PluginPayment_ModulePayment_EntityBill extends EntityORM
{
    const STATE_PAID = 2;
    const STATE_NOT_PAID = 1;
    
    protected $aJsonFields = array(
        'params'
    );
    
    protected $aRelations = array(
        'payment' => array( self::RELATION_TYPE_BELONGS_TO, 'PluginPayment_ModulePayment_EntityPayment', 'payment_id' )
    );
    
    public function isPaid() {
        return ($this->getState() == self::STATE_PAID);
    }
}