@component('mail::message')

Hello {{$invoice->firstname}},{{$invoice->lastname}}


Your Payment for {{$invoice->invoice_title}} under invoice number {{$invoice->id}}

Was successful.You can now enjoy our service 

## Summary

---------------------------------------

    Invoice: {{$invoice->id}}
    Company: {{config('bill-me.org_name')}}

    Item: {{$invoice->invoice_title}}
    Invoice Status: <span style="color:red"> Paid </span>
    OrderId: {{$invoice->orderid}}
    Amount: {{$invoice->amount}}
    E-Mail: {{config('bill-me.your_mail_address')}}
    Notes: {{$invoice->notes}}
    Date: {{$invoice->date}}

Thanks,<br>
{{ config('bill-me.org_name') }}<br>
{{config('bill-me.signature_name')}}
@endcomponent
