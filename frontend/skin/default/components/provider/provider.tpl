{component_define_params params = ['name', 'description', 'classes', 'attributes']}

{block 'provider_options'}
    
{/block}

<div class="media {$classes}"  {cattr list=$attributes}>
  <img class="mr-3" src="{$LS->Component_GetWebPath('payment:provider')}/img/{$name}.png" alt="{$name}">
  <div class="media-body">
    <h5 class="mt-3">{lang "plugin.payment.providers.{$name}.title"}</h5>
    <span class="text-muted">{lang "plugin.payment.providers.{$name}.description"}</span>
  </div>
</div>