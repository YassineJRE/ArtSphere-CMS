@component('mail::message')
<h1>{{ $request->get('subject') }}</h1>
<p><strong>{{ __('emails.views.contact.p.name') }}</strong> {{ app('profile.session')->getName() }}</p>
<p><strong>{{ __('emails.views.contact.p.email') }}</strong> {{ app('profile.session')->getEmail() }}</p>
<p><strong>{{ __('emails.views.contact.p.subject') }}</strong> {{ $request->get('subject') }}</p>
<p><strong>{{ __('emails.views.contact.p.message') }}</strong></p>
<p>{!! $request->get('message') !!}</p>

@endcomponent
