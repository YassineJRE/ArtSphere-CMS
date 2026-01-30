@isset($myCollection)
    <div class="row">
        <div class="col-md-12 my-profile with-separator">
            <div class="col-md-6 my-profile-content margin-top-20 margin-bottom-20">
                {{ __('my-collection.views.show.footer.title') }} <b>{{ $myCollection->title }}</b><br>
            </div>
            <div class="col-md-6 my-profile-content margin-top-20 margin-bottom-20">
                {{ __('my-collection.views.show.footer.artist-owner') }}
                <b>
                    @foreach ($myCollection->exhibitsWithDistinctOwners as $exhibit)
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
                {{ __('my-collection.views.show.footer.description') }} <b>{!! nl2br($myCollection->description) !!}</b><br>
                {{ $myCollection->additional_information_title }} <b>{!! nl2br($myCollection->additional_information_content) !!}</b><br>
            </div>
        </div>
    </div>
@endisset
