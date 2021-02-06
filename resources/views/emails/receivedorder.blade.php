@component('mail::message')
# Introduction
Hello {{$order->firstname}} 
Your order has been received and is being processed 

Thanks,<br>
{{ config('app.org_name') }}<br>
@endcomponent
