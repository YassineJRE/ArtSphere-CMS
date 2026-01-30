@extends('layouts.main')

@section('header_styles')

@stop

@section('title')
    {{ $member->title }}
    @parent
@endsection

@section('page-title')
    {{ $member->title }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        $myGroup->getName() => route('my-group.show',['my_group' => $myGroup->id]),
        __('my-group-member.views.show.breadcrumbs.members') => route('my-group.members.index',[
            'my_group' => $myGroup->id
        ]),
        $member->profile->artist_name => route('my-group.members.show',[
            'my_group' => $myGroup->id,
            'member' => $member->id
        ]),
    ]])
@stop

@section('content')
    @include('components.main-buttons', [
        'leftButtons' => [
            [
                'label' => __('my-group-member.views.show.content.back'),
                'link' => route('my-group.members.index',['my_group' => $myGroup->id]),
                'icon' => 'arrow-left',
                'type' => 'outline'
            ]
        ],
        'rightButtons' => [

        ]
    ])
    <div class="row">
        <div class="col-md-12 my-profile">
            <div class="col-md-6 my-profile-content margin-top-20 margin-bottom-20">
                {{ __('my-group-member.views.show.footer.name') }} <b>{{ $member->account()->getName() }}</b><br>
                {{ __('my-group-member.views.show.footer.role') }} <b>{{ $member->role }}</b><br>
                {{ __('my-group-member.views.show.footer.artist-name') }} <b>{{ $member->profile->artist_name }}</b><br>
            </div>
            <div class="col-md-6 my-profile-content margin-top-20 margin-bottom-20">
                {{ __('my-group-member.views.show.footer.biography') }} <b>{!! nl2br($member->profile->biography) !!}</b><br>
                {{ __('my-group-member.views.show.footer.description') }} <b>{!! nl2br($member->profile->description) !!}</b><br>
            </div>
            <div class="col-md-12 my-profile-buttons">
                <div class="col-md-6 left-buttons">
                    <a href="{{ route('my-group.members.edit',['my_group' => $myGroup->id,'member' => $member->id]) }}"
                        class="button edit"
                    ><i class="sl sl-icon-note"></i> {{ __('my-group-member.views.show.footer.button.edit') }}</a>
                </div>
                <div class="col-md-6 right-buttons">
                    @if (true)
                        <a href="#delete-row-dialog-{{ $member->id }}"
                            class="button delete popup-delete-row"
                        ><i class="sl sl-icon-trash"></i> {{ __('my-group-member.views.show.footer.button.delete') }}</a>
                        <div id="delete-row-dialog-{{ $member->id }}" class="listeo-dialog zoom-anim-dialog mfp-hide">
                            <div class="small-dialog-header">
                                <h3>{{ __('my-group-member.views.show.footer.h3.delete-member') }}</h3>
                            </div>
                            <div class="sign-in-form style-1">
                                <p>{{ __('my-group-member.views.show.footer.p.sure') }}</p>
                                <form method="post"
                                    action="{{ route('my-group.members.destroy',['my_group' => $myGroup->id,'member' => $member->id]) }}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button class="button">
                                        {{ __('my-group-member.views.show.footer.form.button.delete') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

@section('app_scripts')
<script type="text/javascript">
$(document).ready(function (e) {
    $('.popup-delete-row').magnificPopup({
        type: 'inline',
        fixedContentPos: false,
        fixedBgPos: true,
        overflowY: 'auto',
        closeBtnInside: true,
        preloader: false,
        midClick: true,
        removalDelay: 300,
        mainClass: 'art-mfp-zoom-in'
    });
});
</script>
@stop
