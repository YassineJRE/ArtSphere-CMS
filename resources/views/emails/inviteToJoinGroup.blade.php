@component('mail::message')
# {{ __('emails.views.inviteToJoinGroup.hello',['name' => $invitation->getFirstName()]) }},
<p>
    {{-- could use a better if check here, to make sure it's the first invite of the group --}}
@if ($invitation->is_admin)
    {{ __('emails.views.inviteToJoinGroup.p.invite-group',[
        'name' => $invitation->inviter->getName(),
        'group_name' => $invitation->subject->name,
    ]) }}   
@else
    {{ __('emails.views.inviteToJoinGroup.p.invite-you',[
        'name' => $invitation->inviter->getName(),
        'group_name' => $invitation->subject->name,
    ]) }}
@endif
</p>

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