@isset($myExhibit)
    <div class="row">
        <div class="col-md-12 my-profile with-separator">
            <div class="col-md-6 my-profile-content margin-top-20 margin-bottom-20">
                {{ __('my-exhibit.views.show.footer.name') }} <b>{{ $myExhibit->name }}</b><br>
                {{ __('my-exhibit.views.show.footer.description') }} <b>{!! nl2br($myExhibit->description) !!}</b><br>
                {{ __('my-exhibit.views.show.footer.type') }} <b>{{ $myExhibit->type }}</b><br>
                {{__('my-exhibit.views.show.footer.gallery')}} 
                {{-- added && $myExhibit->gallery --}}
                @if(isset($myExhibit->verifier_id) && $myExhibit->gallery)
                    <a style="color: #ff6600;" href="{{ route('app.groups.show', ['group'=>$myExhibit->verifier_id]) }}">{{ $myExhibit->gallery->name }}</a>   
                @endif
                <br>
                {{__('my-exhibit.views.show.footer.verification')}} <b>{{ $myExhibit->verified_status }}</b><br>
                {{ __('my-exhibit.views.show.footer.special-thanks') }} <b>{{ $myExhibit->special_thanks }}</b><br>
                {{ __('my-exhibit.views.show.footer.grant-acknowledgement') }} <b>{{ $myExhibit->grant_acknowledgement }}</b><br>
                {{ $myExhibit->additional_information_title }} <b>{!! nl2br($myExhibit->additional_information_content) !!}</b><br>
            </div>
            <div class="col-md-6 my-profile-content margin-top-20 margin-bottom-20">
                {{ __('my-exhibit.views.show.footer.location') }} <b>{{ $myExhibit->getLocations()->prepend($myExhibit->location)->filter()->unique()->implode(', ') }}</b><br>
                {{ __('my-exhibit.views.show.footer.dates') }} <b>
                    @foreach ($myExhibit->getDatesInYear() as $dateInYear)
                        {{ $dateInYear }}@if (!$loop->last), @endif
                    @endforeach
                </b><br><br>
                {{ __('my-exhibit.views.show.footer.upcoming-date') }}
                    <b>{{ 
                        $myExhibit->upcoming_date ?
                            \Carbon\Carbon::parse($myExhibit->upcoming_date)->format('d M Y') : ''
                    }}</b><br>
                {{ __('my-exhibit.views.show.footer.open-date') }}
                    <b>{{ 
                        $myExhibit->open_at ?
                            \Carbon\Carbon::parse($myExhibit->open_at)->format('d M Y h:m A') : ''
                    }}</b><br>
            </div>
        </div>
    </div>
@endisset