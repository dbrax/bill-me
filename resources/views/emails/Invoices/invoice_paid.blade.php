@component('mail::message')

Hello {{$invoice->firstname}} , {{$invoice->lastname}}
Your Payment for {{$invoice->invoice_title}} was succesful


Thanks,<br>
{{ config('bill-me.name') }}<br>
@endcomponent
