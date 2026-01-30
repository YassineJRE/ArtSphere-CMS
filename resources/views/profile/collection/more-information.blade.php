@isset($collection)
    <section class="fullwidth" data-background-color="#f9f9f9">
        <div class="container" id="more-information">
            <div class="row">
                <div class="col-md-12 my-profile">
                    <div class="col-md-12 my-profile-content margin-top-20 margin-bottom-20">
                        @if ($collection->title)
                            <b>{{ __('profile.views.more-information.title') }}</b> {{ $collection->title }}<br>
                        @endif
                        @if ($collection->description)
                            <b>{{ __('profile.views.more-information.description') }}</b> {!! nl2br($collection->description) !!}<br>
                        @endif
                    </div>
                    @if ($collection->exhibitsWithDistinctOwners->count() > 0)
                        <div class="col-md-12 my-profile-content margin-top-20 margin-bottom-20">
                            <b>{{ __('profile.views.more-information.artists') }}</b>
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
                        </div>    
                    @endif
                    <div class="col-md-12 my-profile-content margin-top-20 margin-bottom-20">
                        <b>{{ __('profile.views.added-by') }}</b>
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
                        <b>{{ __('profile.views.more-information.date-added') }}</b> {{ \Carbon\Carbon::parse($collection->created_at)->isoFormat('Do MMMM YYYY') }}<br>
                    </div>
                    @if ($collection->additional_information_title)
                        <div class="col-md-12 my-profile-content margin-top-20 margin-bottom-20">
                            <b>{!! nl2br($collection->additional_information_title) !!}</b> {!! nl2br($collection->additional_information_content) !!}<br> 
                        </div>                        
                    @endif
                </div>
            </div>
        </div>
    </section>
@endisset