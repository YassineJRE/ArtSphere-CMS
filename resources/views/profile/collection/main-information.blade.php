@isset($collection)
    <div class="row">
        <div 
            id="main-information"
            class="col-md-12 my-profile with-separator"
        >
            <div class="col-md-3 my-profile-content margin-top-20 margin-bottom-20">
                <b>{{ $collection->title }}</b><br>
            </div>
            <div class="col-md-3 my-profile-content margin-top-20 margin-bottom-20">
                <b>
                    @foreach ($collection->exhibitsWithDistinctOwners as $exhibit)
                        <a
                            target="_blank"
                            @if ($exhibit->belongsToProfile())
                                href="{{ route('app.profiles.show',[
                                    'profile' => $exhibit->owner_id, 
                                    'search' => request()->search,
                                    'discover' => request()->discover,
                                ]) }}" 
                            @elseif ($exhibit->belongsToGroup())
                                href="{{ route('app.groups.show',[
                                    'group' => $exhibit->owner_id,
                                    'search' => request()->search,
                                    'discover' => request()->discover,
                                ]) }}"
                            @endif
                        ><u>{{ $exhibit->owner->getName() }}</u></a>@if (!$loop->last), @endif
                    @endforeach
                </b><br>
            </div>
            <div class="col-md-3 my-profile-content margin-top-20 margin-bottom-20">
                {{ __('profile.views.added-by') }}
                <a
                    target="_blank"
                    @if ($collection->belongsToProfile())
                        href="{{ route('app.profiles.show',[
                            'profile' => $collection->owner_id,
                            'search' => request()->search,
                            'discover' => request()->discover,
                        ]) }}" 
                    @elseif ($collection->belongsToGroup())
                        href="{{ route('app.groups.show',[
                            'group' => $collection->owner_id,
                            'search' => request()->search,
                            'discover' => request()->discover,
                        ]) }}"
                    @endif
                ><u><b>{{ $collection->owner->getName() }}</b></u></a><br>
                <a href="#more-information">
                    <u><i>{{ __('profile.views.button.more-information') }}</i></u>
                </a>
            </div>
            <div class="col-md-3 main-information-buttons my-profile-content margin-top-20 margin-bottom-20">
                <div class="padding-bottom-5">
                    <div class="elementor-align-right">
                        @include('profile.collection.top-buttons',['collection' => $collection])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endisset