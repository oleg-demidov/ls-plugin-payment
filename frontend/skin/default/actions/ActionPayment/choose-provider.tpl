{**
 * Отзывы
 *}
{extends 'layouts/layout.base.tpl'}


{block 'layout_page_title'}
    <h1 class="page-header">{lang "plugin.payment.choose_provider.title"}</h1>
{/block}
                    
{block 'layout_content'}
    
    {capture name="bill"}
    <table>
        <tr>
            <td class="pr-5">{lang "plugin.payment.bills.fields.number"}</td>
            <td>{$oPayment->getId()}</td>
        </tr>
        <tr>
            <td class="pr-5">{lang "plugin.payment.bills.fields.description"}</td>
            <td>{$oPayment->getDescription()}</td>
        </tr>
        <tr>
            <td class="pr-5">{lang "plugin.payment.bills.fields.date_create"}</td>
            <td>{$oPayment->getDateCreate()}</td>
        </tr>
        <tr>
            <td class="pr-5">{lang "plugin.payment.bills.fields.state"}</td>
            <td>{if  $oPayment->isPaid()}
                    <span class="text-success">{lang "plugin.payment.bills.states.paid"}</span>
                {else}
                    <span class="text-danger">{lang "plugin.payment.bills.states.not_paid"}</span>
                {/if}
            </td>
        </tr>
        <tr>
            <td class="pr-5">{lang "plugin.payment.bills.fields.price"}</td>
            <td>{$oPayment->getPrice()} {lang "plugin.payment.currency.{$oPayment->getCurrency()}"}</td>
        </tr>
            
    </table>
    {/capture}
    

    {component "bs-card"
        classes = "my-3"
        content=[
            [
                type => 'header',
                content => "Счет"
            ],
            [
                type => 'body',
                content => $smarty.capture.bill
            ]
        ]}
    
    
    <h4>{lang "plugin.payment.choose_provider.h5"}</h4>
            
    <div class="d-flex mt-3 flex-column">
        <div class="d-flex"> 
            <a style="text-decoration: none;" class="text-secondary" href="{router page="payment/process/bill{$oBill->getId()}/robokassa"}"> 
                {component "payment:provider"
                    classes = "border rounded px-3 py-1"
                    name    = "robokassa"
                }
            </a>
        </div>
    </div>
{/block}