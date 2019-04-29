
{extends "component@bs-button"}

{block 'button_options'}
    {component_define_params params=[ 'target_type', 'target_id', 'state', 'count', 'target' ]}
    
    {$icon = [icon => "thumbs-up", display => 'r', classes => 'mr-1']}
    
    {if $target}
        {$count = $target->like->getCount()}
        {$state = $target->like->getUserLike()}
        {$target_type = $target->like->getParam('target_type')}
        {$target_id = $target->getId()}
    {/if}
        
{*    attributes  => [ "data-toggle"=>"modal-tab", "data-target"=>"#nav-tab-authlogin"],*}
    {if $oUserCurrent}
        {$attributes['data-btn'] = true}
        {$attributes['data-like'] = true}
        
    {else}
        {$text = "<span data-toggle='modal-tab' data-target='#nav-tab-authlogin'>{$aLang.plugin.questions.question.actions.like}</span>"}
        {$attributes[ "data-toggle"] = "modal"}
        {$attributes["data-target"] = "#modalAuth"}
    {/if}

    
    
    {$attributes['data-param-target-type'] = $target_type}
    {$attributes['data-param-target-id'] = $target_id}
    {$attributes['data-param-state'] = {$state|default:0}}
    
    {if $state}
        {$classes = "active"}
    {/if}
    
    {if !$count}
        {$badgeClasses = "d-none"}
    {/if}

    {$badge = [
        text => {$count|default:''},
        classes => $badgeClasses,
        bmods => $bmods
    ]}
    
{/block}
