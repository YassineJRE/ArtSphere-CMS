<li>
    <i class="list-box-icon sl sl-icon-plus"></i>
    <strong>
        <a href="#show-causer-dialog-{{ $activity->causer_id }}-{{ $activity->id }}" class="popup-show-info">
            {{ $activity->causer->first_name }} {{ $activity->causer->last_name }}
        </a>
    </strong>
    {{ __('activities.views.created.li.added') }}
    <strong>
        <a href="#show-subject-dialog-{{ $activity->subject_id }}-{{ $activity->id }}" class="popup-show-info">
            {{ Str::afterLast($activity->subject_type, '\\') }}
        </a>
    </strong>
    {{ __('activities.views.created.li.at') }} <b>{{
        \Carbon\Carbon::parse($activity->created_at)->diffForHumans() }}</b>
    <a href="#" class="close-list-item">{{ $activity->id }}</a>
</li>

<div id="show-causer-dialog-{{ $activity->causer_id }}-{{ $activity->id }}"
    class="listeo-dialog ical-import-dialog zoom-anim-dialog  mfp-hide">
    <div class="small-dialog-header">
        <h3>{{ __('activities.views.created.h3.user') }}</h3>
    </div>
    <div class="sign-in-form style-1">
        <p>
            {{ __('activities.views.created.p.causer-id',['id' => $activity->causer_id]) }}
        </p>
        <p>
            {{ __('activities.views.created.p.causer-first_name',['first-name' => $activity->causer->first_name])
            }}
        </p>
        <p>
            {{ __('activities.views.created.p.causer-last_name',['last-name' => $activity->causer->last_name]) }}
        </p>
        <p>
            {{ __('activities.views.created.p.causer-email',['email' => $activity->causer->email]) }}
        </p>
        <p>
            {{ __('activities.views.created.p.causer-created_at',['created_at' => $activity->causer->created_at])
            }} {{ \Carbon\Carbon::parse($activity->causer->created_at)->isoFormat('Do MMMM YYYY, H:mm') }}
        </p>
    </div>
</div>

<div id="show-subject-dialog-{{ $activity->subject_id }}-{{ $activity->id }}"
    class="listeo-dialog ical-import-dialog zoom-anim-dialog  mfp-hide">
    <div class="small-dialog-header">
        <h3>{{ Str::afterLast($activity->subject_type, '\\') }} : {{ $activity->subject_id }}</h3>
    </div>
    @isset($activity->subject)
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>{{ __('activities.views.created.table.thead.tr.th.field') }}</th>
                <th>{{ __('activities.views.created.table.thead.tr.th.value') }}</th>
            </tr>
        </thead>
        <tbody>
            @php
            $viewOfModel = 'admin::components.'.Str::replace(['App','\\'], ['activities','.'], $activity->subject_type);
            @endphp

            @foreach ($activity->subject->toArray() as $key => $attribute)
            @if (is_string($attribute) || is_numeric($attribute))
            <tr>
                <td>{{ $key }}</td>
                <td>{{ $attribute }}</td>
            </tr>
            @endif
            @endforeach

            @includeIf($viewOfModel, ['subject' => $activity->subject])

            @includeWhen(
            Str::contains($viewOfModel, 'SearchCriteriaType'),
            'admin::components.activities.Models.SearchCriteria',
            ['subject' => $activity->subject]
            )
        </tbody>
    </table>
    @endisset
</div>
