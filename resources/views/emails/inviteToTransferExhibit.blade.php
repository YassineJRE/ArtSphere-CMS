@component('mail::message')
# {{ __('emails.views.inviteToTransferExhibit.hello',['name' => $invitation->getFirstName()]) }},


<p>{{ __('emails.views.inviteToTransferExhibit.p.invite-you',[
    'name' => $invitation->inviter->getName(),
]) }}</p>

@component('mail::button', ['url' => $actionUrl])
{{ $actionText }}
@endcomponent

@isset($actionText)
@component('mail::subcopy')
{{ 
    __('emails.views.notifications.email.subcopy',['actionText' => $actionText]) 
}}
<span class="break-all">[{{ $actionUrl }}]({{ $actionUrl }})</span>
@endcomponent
@endisset
@endcomponent