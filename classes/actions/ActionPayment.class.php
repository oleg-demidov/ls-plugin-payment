<?php
/*
 * LiveStreet CMS
 * Copyright © 2013 OOO "ЛС-СОФТ"
 *
 * ------------------------------------------------------
 *
 * Official site: www.livestreetcms.com
 * Contact e-mail: office@livestreetcms.com
 *
 * GNU General Public License, version 2:
 * http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 * ------------------------------------------------------
 *
 * @link http://www.livestreetcms.com
 * @copyright 2013 OOO "ЛС-СОФТ"
 * @author Oleg Demidov 
 *
 */

/**
 * Экшен обработки ajax запросов
 * Ответ отдает в JSON фомате
 *
 * @package actions
 * @since 1.0
 */
class PluginPayment_ActionPayment extends ActionPlugin{
    
    
    protected function RegisterEvent() {
       $this->AddEventPreg( '/^choose-provider$/i', 'EventChooseProvider');

    }
    
    
    public function EventChooseProvider(){
        if(!$oPayment = $this->PluginPayment_Payment_GetPaymentById(getRequest('payment_id'))){
            $this->Message_AddError($this->Lang_Get('plugin.payment.notice.error_choose_bill'));
            Router::LocationAction('/');

        }
    }
    
    public function EventShutdown() {
    }

    public function Init() {
        
    }

}