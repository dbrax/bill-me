@component('mail::message')
 
Hello {{$invoice->firstname}} , {{$invoice->lastname}}
Please find your invoice for an order with id  {{$invoice->orderid}} item {{$invoice->invoice_title}} 


Thanks,<br>
{{ config('bill-me.name') }}<br>
@endcomponent
