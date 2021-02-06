@component('mail::message')
# Introduction
Hello 
You have a new order from {{$order->firstname}} , {{$order->lastname}}
Login and process it.

Thanks,<br>
{{ config('app.org_name') }}<br>
@endcomponent
