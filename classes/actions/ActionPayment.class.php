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
    
    public function Init()
    {
        
    }
    protected function RegisterEvent() {
        
        $this->AddEventPreg( '/^[\w_-]+$/i', '/^bills$/i', '/^(paid|not_paid)?$/i', '/^(page([\d]+))?$/i', ['EventBills', 'settings']);
        $this->AddEventPreg(  '/^choose-provider$/i', 'EventChooseProvider');
        $this->AddEventPreg(  '/^process$/i', '/^[\w_-]+$/i', 'EventProcess');
    }
    
    public function EventBills($oUserProfile = null) {
        $sState = $this->GetParam(1, 'not_paid');
        
        $iPage = $this->GetParamEventMatch(2,2)?$this->GetParamEventMatch(2,2):1;
        
        if(!$oUserProfile and !$oUserProfile = $this->User_GetUserByLogin($this->sCurrentEvent)){
            return $this->EventNotFound();
        }
        
        $aFilter = [
            'user_id' => $oUserProfile->getId(),
            '#page' => [$iPage, Config::Get('plugin.payment.bills.per_page')],
            '#order' => ['date_create' => 'desc']
        ];
        
        if($sState == 'no_paid'){
            $aFilter["date_payment"] = null;
        }elseif($sState == 'paid'){
            $aFilter['#where'] = [
                't.date_payment IS NOT NULL AND 1=?d' => [1]
            ];
        }
        
        
        
        $aBills = $this->PluginPayment_Payment_GetBillItemsByFilter($aFilter);
        
        $aPaging = $this->Viewer_MakePaging(
            $aBills['count'], 
            $iPage, 
            Config::Get('plugin.payment.bills.per_page'), 
            Config::Get('plugin.payment.bills.view_page_count'), 
            Router::GetPath('payment/'.$oUserProfile->getLogin().'/bills/'.$sState)
        ); 
        
        $iCountPaid = $this->PluginPayment_Payment_GetCountFromBillByFilter([
            '#where' => [
                't.date_payment IS NOT NULL AND 1=?d' => [1]
            ]
        ]);
        $iCountNotPaid = $this->PluginPayment_Payment_GetCountFromBillByFilter(['date_payment' => null]);
        
        $this->Menu_Get('profile')->setActiveItem('bills');
        $this->SetTemplateAction('bills');
        
        $this->Viewer_Assign('iCountPaid', $iCountPaid);
        $this->Viewer_Assign('iCountNotPaid', $iCountNotPaid);
        $this->Viewer_Assign('aBills', $aBills['collection']);
        $this->Viewer_Assign('aPaging', $aPaging);
        $this->Viewer_Assign('sState', $sState);
        $this->Viewer_Assign('oUserProfile', $oUserProfile);
    }
     
    
    public function EventBillPaid($oBill) {
        $this->Viewer_Assign('oBill', $oBill);
        $this->SetTemplateAction('bill-paid');
    }
    
    public function EventChooseProvider(){
        $oUserProfile = $this->User_GetUserCurrent();
                        
        if(!$oBill = $this->PluginPayment_Payment_GetBillById(getRequest('bill'))){
            $this->Message_AddError($this->Lang_Get('plugin.payment.notice.error_choose_bill'), null, true);
            Router::LocationAction('payment/'.$oUserProfile->getLogin().'/bills');
        }
        
        $this->Viewer_Assign('oBill', $oBill);
        $this->SetTemplateAction('choose-provider');        
    }
    
    public function EventProcess() {
        if(!$oBill = $this->PluginPayment_Payment_GetBillById(getRequest('bill'))){
            $this->Message_AddError($this->Lang_Get('plugin.payment.notice.error_choose_bill'), null, true);
            Router::LocationAction('payment/'.$oUserProfile->getLogin().'/bills');
        }        
        
        if(!$oProvider = $this->PluginPayment_Payment_GetProvider($this->GetParam(0))){
            $this->Message_AddError($this->Lang_Get('plugin.payment.notice.error_choose_bill', ['provider' => $this->GetParam(0)]));
            return $this->EventChooseProvider();
        }
    }
}