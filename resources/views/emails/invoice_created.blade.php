@component('mail::message')

Hello {{$invoice->firstname}} , {{$invoice->lastname}}
Please find your invoice for Your Order \
\
{{$invoice->invoice_title}}  \
\
{{config('bill-me.currency')}} <space></space> {{$invoice->amount}} 


Thanks,<br>
{{ config('bill-me.name') }}<br>
@endcomponent
