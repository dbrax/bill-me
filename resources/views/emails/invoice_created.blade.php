@component('mail::message')

Hello {{$invoice->firstname}} , {{$invoice->lastname}}
Please find your invoice for Your Order \

# Summary

---------------------------------------

    Invoice: {{$invoice->id}}
    Company: {{config('bill-me.org_name')}}

    Item: {{$invoice->invoice_title}}
    
    OrderId: {{$invoice->orderid}}
    Amount: {{$invoice->amount}}
    E-Mail: {{config('bill-me.your_mail_address')}}
    Notes: {{$invoice->notes}}
    Date: {{$invoice->date}}

Thanks,<br>
{{ config('bill-me.name') }}<br>
@endcomponent
