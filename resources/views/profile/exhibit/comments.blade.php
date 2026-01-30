@isset($exhibit)
    <div class="elementor-element elementor-widget elementor-widget-text-editor col-md-12">
        <div class="elementor-widget-container" id="comments">
            @foreach ($exhibit->allComments() as $comment)
                @if ($comment->forExhibit())
                    @include('profile.exhibit.comment',[
                        'comment' => $comment
                    ])
                @elseif ($comment->forArtwork())
                    @include('profile.exhibit.artwork.comment',[
                        'artwork' => $comment->commentable,
                        'comment' => $comment
                    ])
                @endif
            @endforeach
        </div>
    </div>

    @auth
        @include('profile.exhibit.send-comment')
    @endauth
@endisset