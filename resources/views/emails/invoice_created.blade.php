@component('mail::message')
@php
    $i=1;
@endphp 
Hello {{$invoice->firstname}} , {{$invoice->lastname}}
Please find your invoice for Your Order
| SN            | Item                           | Amount                                               |
| ------------- |:------------------------------:| ----------------------------------------------------:|                       
| {{$i}}        | {{$invoice->invoice_title}}    | {{config('bill-me.currency')}}{{$invoice->amount}}   |


Thanks,<br>
{{ config('bill-me.name') }}<br>
@endcomponent
