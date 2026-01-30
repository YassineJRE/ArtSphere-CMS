<li>
    <i class="list-box-icon sl sl-icon-login"></i>
    <strong>
        @isset($activity->causer)
        <a href="#show-user-dialog-{{ $activity->causer->id }}" class="popup-show-info">
            {{ $activity->causer->first_name }} {{ $activity->causer->last_name }}
        </a>
        @else
        System
        @endisset
    </strong>
    {{ __('activities.views.login.li.logged-at') }} <b>{{
        \Carbon\Carbon::parse($activity->created_at)->diffForHumans() }}</b>
    <a href="#" class="close-list-item">{{ $activity->id }}</a>
</li>

@isset($activity->causer)
<div id="show-user-dialog-{{ $activity->causer->id }}"
    class="listeo-dialog ical-import-dialog zoom-anim-dialog  mfp-hide">
    <div class="small-dialog-header">
        <h3>{{ __('activities.views.login.h3.user') }}</h3>
    </div>
    <div class="sign-in-form style-1">
        <p>
            {{ __('activities.views.login.p.causer-id',[
            'id' => $activity->causer->id
            ]) }}
        </p>
        <p>
            {{ __('activities.views.login.p.causer-first_name',[
            'first-name' => $activity->causer->first_name
            ]) }}
        </p>
        <p>
            {{ __('activities.views.login.p.causer-last_name',[
            'last-name' => $activity->causer->last_name
            ]) }}
        </p>
        <p>
            {{ __('activities.views.login.p.causer-email',[
            'email' => $activity->causer->email
            ]) }}
        </p>
        <p>
            {{ __('activities.views.login.p.causer-created_at',[
            'created_at' => $activity->causer->created_at
            ]) }} {{ \Carbon\Carbon::parse($activity->causer->created_at)->isoFormat('Do MMMM YYYY, H:mm') }}
        </p>
    </div>
</div>
@endisset
