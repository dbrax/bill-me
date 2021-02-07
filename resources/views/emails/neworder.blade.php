@component('mail::message')
# Introduction
Hello 
You have a new order from {{$order->firstname}} , {{$order->lastname}}
Login and process it.

Thanks,<br>
{{ config('bill-me.org_name') }}<br>
@endcomponent
