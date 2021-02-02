@component('mail::message')
# Introduction
Hello {{$order->firstname}} 
Your order has been received and it's being processed 

Thanks,<br>
{{ config('app.name') }}<br>
@endcomponent
