<li>
    <i class="list-box-icon sl sl-icon-pencil"></i>
    <strong>
        <a href="#show-causer-dialog-{{ $activity->causer_id }}-{{ $activity->id }}" class="popup-show-info">
            {{ $activity->causer->first_name }} {{ $activity->causer->last_name }}
        </a>
    </strong>
    {{ __('activities.views.updated.li.updated-model') }}
    <strong>
        <a href="#show-subject-dialog-{{ $activity->subject_id }}-{{ $activity->id }}" class="popup-show-info">
            {{ Str::afterLast($activity->subject_type, '\\') }}
        </a>
    </strong>
    {{ __('activities.views.updated.li.at') }} <strong>{{
        \Carbon\Carbon::parse($activity->created_at)->diffForHumans() }}</strong>
    <a href="#" class="close-list-item">{{ $activity->id }}</a>
</li>

<div id="show-causer-dialog-{{ $activity->causer_id }}-{{ $activity->id }}"
    class="listeo-dialog ical-import-dialog zoom-anim-dialog  mfp-hide">
    <div class="small-dialog-header">
        <h3>{{ __('activities.views.updated.h3.user') }}</h3>
    </div>
    <div class="sign-in-form style-1">
        <p>
            {{ __('activities.views.updated.p.causer-id',['id' => $activity->causer_id]) }}
        </p>
        <p>
            {{ __('activities.views.updated.p.causer-first_name',['first-name' => $activity->causer->first_name])
            }}
        </p>
        <p>
            {{ __('activities.views.updated.p.causer-last_name',['last-name' => $activity->causer->last_name]) }}
        </p>
        <p>
            {{ __('activities.views.updated.p.causer-email',['email' => $activity->causer->email]) }}
        </p>
        <p>
            {{ __('activities.views.updated.p.causer-created_at',['created_at' => $activity->causer->created_at])
            }} {{ \Carbon\Carbon::parse($activity->causer->created_at)->isoFormat('Do MMMM YYYY, H:mm') }}
        </p>
    </div>
</div>

<div id="show-subject-dialog-{{ $activity->subject_id }}-{{ $activity->id }}"
    class="listeo-dialog ical-import-dialog zoom-anim-dialog  mfp-hide">
    <div class="small-dialog-header">
        <h3>{{ Str::afterLast($activity->subject_type, '\\') }} : {{ $activity->subject_id }}</h3>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>{{ __('activities.views.updated.table.thead.tr.th.field') }}</th>
                <th>{{ __('activities.views.updated.table.thead.tr.th.old-value') }}</th>
                <th>{{ __('activities.views.updated.table.thead.tr.th.new-value') }}</th>
            </tr>
        </thead>
        <tbody>
            @isset($activity->properties['attributes'])
            @foreach ($activity->properties['attributes'] as $key => $attribute)
            <tr>
                <td>{{ $key }}</td>
                <td>
                    @if (is_string($activity->properties['old'][$key]) ||
                    is_numeric($activity->properties['old'][$key]))
                    {{ $activity->properties['old'][$key] }}
                    @elseif (is_array($activity->properties['old'][$key]))
                    {{ json_encode($activity->properties['old'][$key]) }}
                    @endif
                </td>
                <td>
                    @if (is_string($attribute) || is_numeric($attribute))
                    {{ $activity->properties['attributes'][$key] }}
                    @elseif (is_array($activity->properties['attributes'][$key]))
                    {{ json_encode($activity->properties['attributes'][$key]) }}
                    @endif
                </td>
            </tr>
            @endforeach
            @endisset
        </tbody>
    </table>
</div>
