@isset($artwork)
    <div class="elementor-element elementor-widget elementor-widget-listeo-headline col-md-12">
        <div class="elementor-widget-container">
            <h4 style="text-align:left;" 
                class="headline headline-box "
            >{{ __('profile.views.comments.title') }}</h4>
        </div>
    </div>

    @include('profile.exhibit.artwork.send-comment', ['artwork' => $artwork])

    <div class="elementor-element elementor-widget elementor-widget-text-editor col-md-12">
        <div class="elementor-widget-container" id="comments">
            @foreach ($artwork->comments as $comment)
                @include('profile.exhibit.artwork.comment',[
                    'artwork' => $artwork,
                    'comment' => $comment
                ])            
            @endforeach
        </div>
    </div>
@endisset