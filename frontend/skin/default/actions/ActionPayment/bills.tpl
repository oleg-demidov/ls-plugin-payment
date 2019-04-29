{**
 * Отзывы
 *}
{extends 'layouts/layout.base.tpl'}


{block 'layout_page_title'}
    <h1 class="page-header">{lang "plugin.payment.bills.title"}</h1>
{/block}
                    
{block 'layout_content'}
    
    {$aStates = [
        [
            count => $iCountNotPaid,
            text => $aLang.plugin.payment.bills.states.not_paid,
            name => 'not_paid',
            url  => {router page="payments/{$oUserProfile->getLogin()}/bills/not_paid"}
        ],
        [
            count => $iCountPaid,
            text => $aLang.plugin.payment.bills.states.paid,
            name => 'paid',
            url  => {router page="payments/{$oUserProfile->getLogin()}/bills/paid"}
        ]
    ]}

    {component "bs-nav" 
        activeItem = 'not_paid'
        bmods = "tabs"
        items = $aStates}

    {if $aBills}
        <table class="table mt-3 mb-0">
            
            <tbody>
                {foreach $aBills as $oBill}
                    <tr>
                        <th>{$oBill->getId()}</th>
                        <td>{$oBill->getDescription()}</td>
                        <td>{$oBill->getDateCreate()}</td>
                        <td>
                            {component "bs-button" 
                                text  = $aLang.plugin.payment.bills.pay
                                bmods = "outline-success sm" }
                        </td>
                    </tr>
                {/foreach}
                
            </tbody>
        </table>

      
    {else}
        {component "blankslate" 
            classes = "mt-3"
            text    = $aLang.plugin.payment.bills.blankslate.text}
    {/if}
{/block}