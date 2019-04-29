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
class PluginLike_ActionFavourites extends ActionPlugin{
    
    public function Init()
    {
        
    }
    protected function RegisterEvent() {
        $this->AddEventPreg('/^[\w_-]+$/i', '/^([\w_-]+)?$/i', '/^(page([\d]+))?$/i',['EventList', 'favourite']);
    }
    
    public function EventList() {
        $this->SetTemplateAction('list');
        
        if (!$oUserProfile = $this->User_GetUserByLogin($this->sCurrentEvent)) {
            return $this->EventNotFound();
        }
        
        $aTargets = $this->PluginLike_Like_GetTargetItemsByFilter([
            '#index-from' => 'code'
        ]);
        
        $oTargetActive = current($aTargets);
        if($aTargets and isset($aTargets[$this->GetParam(0)])){
            $oTargetActive = $aTargets[$this->GetParam(0)];
        }
        
        $this->Menu_Get('profile')->setActiveItem('favourites');
        $this->Viewer_Assign('oUserProfile', $oUserProfile);
        $this->Viewer_Assign('aTargets', $aTargets);
        $this->Viewer_Assign('oTargetActive', $oTargetActive);
        
        if(!$oTargetActive){
            return;
        }
        
        $iPage = $this->GetParamEventMatch(1,2)?$this->GetParamEventMatch(1,2):1;
        
        $aLikes = $this->PluginLike_Like_GetLikeItemsByFilter([
            'type_id' => $oTargetActive->getId(),
            'user_id' => $oUserProfile->getId(),
            '#index-from' => 'target_id',
            '#page' => [$iPage, Config::Get('plugin.like.favourites.per_page')]
        ]);
       
        $aPaging = $this->Viewer_MakePaging(
            $aLikes['count'], 
            $iPage, 
            Config::Get('plugin.like.favourites.per_page'), 
            Config::Get('plugin.like.favourites.view_page_count'), 
            Router::GetPath('favourites/'.$oUserProfile->getLogin().'/'.$oTargetActive->getCode())
        );        
        
        $aEntities = $this->PluginLike_Like_GetItemsByFilter([
            'id in' => array_merge(array_keys($aLikes['collection']),[0]),
            '#order' => ['date_create' => 'desc']
        ], $oTargetActive->getEntity());
       
        $this->Viewer_Assign('aPaging', $aPaging);
        $this->Viewer_Assign('aEntities', $aEntities);
    }
}