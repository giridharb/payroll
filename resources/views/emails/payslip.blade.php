@component('mail::message')
Hello {{$employee->first_name}},'

Please find enclosed salary slip f/m {{ $payslip->month_of_pay->format('F, Y')}}

Let us know in case any clarification required(Regarding Extra Credited/Debited).


Thanks,<br>
{{ config('app.name') }}
@endcomponent
