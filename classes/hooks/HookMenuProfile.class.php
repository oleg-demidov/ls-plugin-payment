<?php


class PluginPayment_HookMenuProfile extends Hook{
    public function RegisterHook()
    {
        $this->AddHook('engine_init_complete', 'NavProfile');      
    }

    /**
     * Добавляем в главное меню 
     */
    public function NavProfile($aParams)
    {
        if(!$oUser = $this->User_GetUserCurrent()){
            return false;
        }
        
        $oMenuProfile = $this->Menu_Get('profile');
        $oMenuUser = $this->Menu_Get('user');        
        
        $oItem = Engine::GetEntity("ModuleMenu_EntityItem", [
            'name' => 'bills',
            'title' => 'plugin.payment.nav_profile.text',
            'url' => 'payment/'.$oUser->getLogin().'/bills',
            'count' => $this->PluginPayment_Payment_GetCountFromBillByFilter(['user_id' => $oUser->getId()])
        ]);
        
        $oMenuProfile->appendChild($oItem);
        $oMenuUser->appendChild($oItem);
        
    }
    
}
