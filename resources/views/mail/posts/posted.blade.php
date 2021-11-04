@component('mail::message')
# Someone Posted

**{{ $user->username }} ** has posted on your page


@component('mail::button', ['url' => route('dashboard.index')])
Go to see what they wrote
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
