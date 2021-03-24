@component('mail::message')

Hello 
You have a new order from {{$order->firstname}} , {{$order->lastname}}
Login and process it.

Thanks,<br>
{{ config('bill-me.org_name') }}<br>
{{config('bill-me.signature_name')}}

@endcomponent
