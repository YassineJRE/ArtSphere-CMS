@component('mail::message')
# {{ __('emails.views.notifyArtistOfExhibitTransfer.hello',['name' => $exhibit->owner->getFirstName()]) }},


<p>{{ __('emails.views.notifyArtistOfExhibitTransfer.p.transfer-you',[
    'name' => $exhibit->transferor->getName(),
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