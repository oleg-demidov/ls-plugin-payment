<?php

class PluginPayment_ModulePayment_EntityPayment extends EntityORM
{
    
    protected $aRelations = array(
        'bills' => array( self::RELATION_TYPE_HAS_MANY, 'PluginPayment_ModulePayment_EntityBill', 'payment_id' )
    );
    
    protected $aValidateRules = [
    ];
    
}