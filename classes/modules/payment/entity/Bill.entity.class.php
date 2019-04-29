<?php

class PluginPayment_ModulePayment_EntityBill extends EntityORM
{
    
    protected $aJsonFields = array(
        'params'
    );
    
    protected $aRelations = array(
        'payment' => array( self::RELATION_TYPE_BELONGS_TO, 'PluginPayment_ModulePayment_EntityPayment', 'payment_id' )
    );
    
        
}