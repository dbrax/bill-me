@component('mail::message')

Hello {{$order->firstname}} 
Your order has been received and is being processed 

Thanks,<br>
{{ config('bill-me.org_name') }}<br>
{{config('bill-me.signature_name')}}

@endcomponent
