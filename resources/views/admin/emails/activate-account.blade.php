@component('mail::message')
{{ __('admin-emails.views.activate-account.p.hello') }} {{ $user->first_name }},

    {{ __('admin-emails.views.activate-account.p.activate') }}

@component('mail::button', ['url' => $actionUrl])
{{ $actionText }}
@endcomponent

{{ __('admin-emails.views.activate-account.p.time-limit') }}

{{ __('admin-emails.views.activate-account.p.thanks') }}<br>
{{ config('app.name') }} {{ __('admin-emails.views.activate-account.p.team') }}

@isset($actionText)
@component('mail::subcopy')
{{ __('admin-emails.views.activate-account.p.trouble') }} "{{ $actionText }}" {{ __('admin-emails.views.activate-account.p.copy-paste') }}
<span class="break-all">[{{ $actionUrl }}]({{ $actionUrl }})</span>
@endcomponent
@endisset
@endcomponent
