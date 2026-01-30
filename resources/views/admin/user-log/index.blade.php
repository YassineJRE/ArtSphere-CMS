@extends('admin.layouts.default')

@section('title')
    {{ __('admin-user-log.views.index.title') }}
    @parent
@stop

@section('header_styles')

@stop

@section('content')
    <div class="dashboard-list-box with-icons margin-top-20">
        <h4>{{ __('admin-user-log.views.index.h4.recent-activities') }}</h4>
        <ul>
            @foreach ($activities as $activity)
                @includeIf('admin::components.activities.'.$activity->event, [
                    'activity' => $activity
                ])
            @endforeach
        </ul>
    </div>

    @include('admin.components.pagination', ['results' => $activities])
@stop

@section('app_scripts')
<script type="text/javascript">
    $(function () {
        $('.popup-show-info').magnificPopup({
            type: 'inline',
            fixedContentPos: false,
            fixedBgPos: true,
            overflowY: 'auto',
            closeBtnInside: true,
            preloader: false,
            midClick: true,
            removalDelay: 300,
            mainClass: 'my-mfp-zoom-in'
        });
    });
</script>
@stop
