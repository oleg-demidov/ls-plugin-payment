{**
 * Отзывы
 *}
{extends 'layouts/layout.base.tpl'}


{block 'layout_page_title'}
    <h1 class="page-header">{lang "plugin.payment.trash.title"}</h1>
{/block}
                    
{block 'layout_content'}
    
    {$aStates = [
        [
            count => $iCountNotPaid,
            text => $aLang.plugin.payment.trash.states.not_paid,
            name => 'not_paid',
            url  => {router page="payment/{$oUserProfile->getLogin()}/trash/not_paid"}
        ],
        [
            count => $iCountPaid,
            text => $aLang.plugin.payment.trash.states.paid,
            name => 'paid',
            url  => {router page="payment/{$oUserProfile->getLogin()}/trash/paid"}
        ]
    ]}

    {component "bs-nav" 
        activeItem = $sState
        bmods = "tabs"
        items = $aStates}

    {if $aProducts}
        <form action="{router page="payment/process"}">
            <table class="table mt-3 mb-0">
                {foreach $aProducts as $oProduct}
                    <tr>
                        <th>{$oProduct->getId()}</th>
                        <td>{component "bs-form.checkbox" name="products[]" value=$oProduct->getId()}</td>
                        <td>{$oProduct->getDescription()}</td>
                        <td>{$oProduct->getDateCreate()}</td>
                        <td>{$oProduct->getPrice()} {lang "plugin.payment.currency.{$oProduct->getCurrency()}"}</td>
                        <td>
                            {component "bs-button" 
                                url   = {router page="payment/process/?products[]={$oProduct->getId()}"}
                                text  = $aLang.plugin.payment.trash.pay
                                bmods = "outline-success sm" }
                        </td>
                    </tr>
                {/foreach}
            </table>
            <hr class="m-0">
            {component "bs-button" 
                classes = "mt-3"
                bmods   = "success"
                type    = "submit" 
                text    = $aLang.plugin.payment.trash.pay}
        </form>
        
      
        {component 'bs-pagination' 
            total   = $aPaging['iCountPage'] 
            padding = 2
            showPager=true
            classes = "mt-3"
            current= $aPaging['iCurrentPage']  
            url="{$aPaging['sBaseUrl']}/page__page__" }
    {else}
        {component "blankslate" 
            classes = "mt-3"
            text    = $aLang.plugin.payment.trash.blankslate.text}
    {/if}
{/block}