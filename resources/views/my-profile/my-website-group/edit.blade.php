@extends('layouts.main')

@section('title')
    {{ $myWebsiteGroup->title }}
    @parent
@endsection

@section('page-title')
    {{ $myWebsiteGroup->title }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        $myProfile->getName() => route('my-profile.show',['my_profile' => $myProfile->id]),
        __('my-website-group.views.edit.breadcrumbs.my-websites') => route('my-profile.my-website-groups.index',[
            'my_profile' => $myProfile->id
        ]),
        $myWebsiteGroup->title => route('my-profile.my-website-groups.show',[
            'my_profile' => $myProfile->id,
            'my_website_group' => $myWebsiteGroup->id
        ]),
        __('my-website-group.views.edit.breadcrumbs.to-edit')
    ]])
@stop

@section('content')
    @include('components.notifications')

    @include('my-profile.my-website-group.edit-form',['myWebsiteGroup' => $myWebsiteGroup])
@stop

@section('app_scripts')
<script type="text/javascript">
    $(function () {
        $('#type').change(function(){
            if (this.value == 'other') {
                $('div.specify_website_group_type').removeClass('hidden');
            } else {
                $('div.specify_website_group_type').addClass('hidden');
            }
        });
    });
</script>
@stop
