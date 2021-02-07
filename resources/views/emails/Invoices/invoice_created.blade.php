@component('mail::message')
# Introduction
Hello 
Hi {{$invoice->firstname}} , {{$invoice->lastname}}
Your invoice for an order with id  {{$invoice->orderid}} 


Thanks,<br>
{{ config('billme.name') }}<br>
@endcomponent
