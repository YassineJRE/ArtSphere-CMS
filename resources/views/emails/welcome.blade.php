@component('mail::message')
# {{ __('emails.views.welcome.hello', ['name' => $user->first_name]) }},

{{ __('emails.views.welcome.welcome-to') }}<br>

{{ __('emails.views.welcome.i-hope') }}<br>

{{ __('emails.views.welcome.dont-hesitate') }}<br>

{{ __('emails.views.notifications.email.regards') }},<br>
Jean-Denis Boudreau<br>
{{ __('emails.app.name') }}
@endcomponent
