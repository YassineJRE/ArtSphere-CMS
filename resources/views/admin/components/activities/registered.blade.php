@isset($activity->causer)
    <li>
        <i class="list-box-icon sl sl-icon-user-follow"></i>
        <strong>
            <a href="#show-causer-dialog-{{ $activity->causer_id }}-{{ $activity->id }}" class="popup-show-info">
                {{ $activity->causer->first_name }} {{ $activity->causer->last_name }}
            </a>
        </strong>
        {!! __('activities.views.registered.li.registered-at', ['date' => \Carbon\Carbon::parse($activity->created_at)->diffForHumans()]) !!}
        <a href="#" class="close-list-item">{{ $activity->id }}</a>
    </li>

    <div id="show-causer-dialog-{{ $activity->causer_id }}-{{ $activity->id }}" class="listeo-dialog ical-import-dialog zoom-anim-dialog  mfp-hide">
        <div class="small-dialog-header">
            <h3>{{ __('activities.views.registered.h3.user') }}</h3>
        </div>
        <div class="sign-in-form style-1">
            <p>
                {{  __('activities.views.registered.p.causer-id',['id' => $activity->causer->id]) }}
            </p>
            <p>
                {{  __('activities.views.registered.p.causer-first_name',['first-name' => $activity->causer->first_name]) }}
            </p>
            <p>
                {{  __('activities.views.registered.p.causer-last_name',['last-name' => $activity->causer->last_name]) }}
            </p>
            <p>
                {{  __('activities.views.registered.p.causer-email',['email' => $activity->causer->email]) }}
            <p>
                {{ __('activities.views.login.p.causer-created_at',['created_at' => \Carbon\Carbon::parse($activity->causer->created_at)->isoFormat('Do MMMM YYYY, H:mm')]) }}
            </p>
        </div>
    </div>
@endisset
