@isset($myGroup)
{{-- Section exhibits --}}
@if($myGroup->isApproved())
<form action="{{ route('my-group.verification.index', ['my_group' => $myGroup->id]) }}" method="GET" id="filter-form">
    <label for="filter">{{__('my-group-verification.views.list.form.filter.label.select-filter')}}</label>
    <select name="filter" id="filter" onchange="document.getElementById('filter-form').submit();">
        @foreach (\App\Enums\VerifiedStatus::list() as $status)
            <option value="{{$status}}" {{ request('filter') == $status ? 'selected' : '' }}>{{__('my-group-verification.views.list.form.filter.option.'.$status)}}</option>
        @endforeach
        <option value="All" {{ request('filter') == 'All' ? 'selected' : '' }} >{{__('my-group-verification.views.list.form.filter.option.all')}}</option>
    </select>
    {{-- <button type="submit">{{__('my-group-verification.views.list.form.filter.button.submit')}}</button> --}}
</form>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@php
    $exhibits = $filter=='All'? $myGroup->verificationExhibits(): $myGroup->filterVerificationExhibits($filter);
    // uncomment to hide private exhibits from list
    // $exhibits = $exhibits->filter();
@endphp
@if ($exhibits->count() > 0)
@php
    $exhibitsPaginated = $exhibits->orderBy('order_column')->paginate(6);
@endphp
<div id="dokan-seller-listing-wrap" class="grid-view">
    <div class="seller-listing-content">
        <ul class="dokan-seller-wrap">
            @foreach ($exhibitsPaginated as $exhibit)
                <li class="dokan-single-seller woocommerce coloum-3 ">
                    <a href="{{route('my-group.verification.show', ['my_group'=> $myGroup->id,'exhibit'=>$exhibit->id])}}">
                        <div class="store-wrapper">
                            <div class="store-header">
                                <div class="store-banner">
                                    @include('components.media.exhibit', [
                                        'exhibit' => $exhibit
                                    ])
                                </div>
                            </div>
                            <div class="store-content ">
                                <div class="store-data-container">
                                    @if ($exhibit->isEnabled())
                                        <span
                                            class="dokan-store-is-open-close-status"
                                            title="Exhibit is published"
                                        >{{ __('enums.status.enabled') }}</span>
                                    @elseif ($exhibit->isToVerifiedGalleriesOnly())
                                        <span
                                            class="dokan-store-is-open-close-status"
                                            title="Exhibit is published for verified Galleries"
                                        >{{ __('enums.status.to-verified-galleries-only') }}</span>
                                    @elseif ($exhibit->isDisabled())
                                        <span
                                            class="dokan-store-is-open-close-status dokan-store-is-closed-status"
                                            title="Exhibit is unpublished"
                                        >{{ __('enums.status.disabled') }}</span>
                                    @endif
                                    <div class="featured-favourite"></div>
                                    <div class="store-data">
                                        <h2>{{ $exhibit->name }}</h2>
                                        <p>{{ $exhibit->type }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="store-footer">
                                @if ($exhibit->belongsToProfile() || app('profile.session')->isAdministratorOfThisGroup($exhibit->owner))
                                @if ($exhibit->isPendingVerification())
                                <span>{{__('my-group-verification.views.list.span.status-pending')}}</span><br>
                                <form action="{{ route('my-group.verification.update', ['my_group'=>$myGroup->id,'exhibit'=>$exhibit->id]) }}" method="POST"  style="display: inline;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="verified_status" value="{{\App\Enums\VerifiedStatus::APPROVED}}">
                                    <button class="button publish" type="submit">{{__('my-group-verification.views.list.button.confirm-verification')}}</button>
                                </form>
                                <form action="{{ route('my-group.verification.update', ['my_group'=>$myGroup->id,'exhibit'=>$exhibit->id]) }}" method="POST"  style="display: inline;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="verified_status" value="{{\App\Enums\VerifiedStatus::DENIED}}">
                                    <button class="button publish" type="submit">{{__('my-group-verification.views.list.button.deny-verification')}}</button>
                                </form>
                                @elseif ($exhibit->isVerified())
                                <span>{{__('my-group-verification.views.list.span.status-approved')}}</span><br>
                                <form action="{{ route('my-group.verification.update', ['my_group'=>$myGroup->id,'exhibit'=>$exhibit->id]) }}" method="POST"  style="display: inline;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="verified_status" value="{{\App\Enums\VerifiedStatus::PENDING}}">
                                    <button class="button publish" type="submit">{{__('my-group-verification.views.list.button.revoke-verification')}}</button>
                                </form>
                                <form action="{{ route('my-group.verification.update', ['my_group'=>$myGroup->id,'exhibit'=>$exhibit->id]) }}" method="POST"  style="display: inline;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="verified_status" value="{{\App\Enums\VerifiedStatus::DENIED}}">
                                    <button class="button publish" type="submit">{{__('my-group-verification.views.list.button.deny-verification')}}</button>
                                </form>
                                @elseif ($exhibit->wasDeniedVerification())
                                <span>{{__('my-group-verification.views.list.span.status-denied')}}</span><br>
                                <form action="{{ route('my-group.verification.update', ['my_group'=>$myGroup->id,'exhibit'=>$exhibit->id]) }}" method="POST"  style="display: inline;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="verified_status" value="{{\App\Enums\VerifiedStatus::PENDING}}">
                                    <button class="button publish" type="submit">{{__('my-group-verification.views.list.button.restate-pending')}}</button>
                                </form>
                                <form action="{{ route('my-group.verification.update', ['my_group'=>$myGroup->id,'exhibit'=>$exhibit->id]) }}" method="POST"  style="display: inline;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="verified_status" value="{{\App\Enums\VerifiedStatus::APPROVED}}">
                                    <button class="button publish" type="submit">{{__('my-group-verification.views.list.button.denial-to-verification')}}</button>
                                </form>
                                @endif 
                                @endif
                            </div>
                        </div>
                    </a>
                </li>
            @endforeach
            <div class="dokan-clearfix"></div>
        </ul>
    </div>
</div>

{{-- Section pagination myExhibits--}}
@include('components.main-buttons', [
    'rightButtons' => [
        ( $exhibitsPaginated->previousPageUrl() ? [
            'label' => '',
            'link' => $exhibitsPaginated->previousPageUrl(),
            'icon' => 'arrow-left',
            'type' => 'outline'
            ] : []
        ),
        ( $exhibitsPaginated->nextPageUrl() ? [
            'label' => '',
            'link' => $exhibitsPaginated->nextPageUrl(),
            'icon' => 'arrow-right',
            'type' => 'outline'
            ] : []
        )
    ]
])
{{-- End Section pagination myExhibits--}}
@else
    <span>{{__('my-group-verification.views.list.span.no-exhibits')}}</span>
@endif
@else
    <span>{{__('my-group-verification.views.list.span.not-verified')}}</span>
@endif
{{-- End Section exhibits --}}
@endisset