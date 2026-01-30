@isset($collection)
    {{-- <div class="elementor-element elementor-widget elementor-widget-listeo-headline">
        <div class="elementor-widget-container">
            <h4 style="text-align:left;" 
                class="headline headline-box "
            >{{ __('profile.views.comments.title') }}</h4>
        </div>
    </div> --}}

    <div class="elementor-element elementor-widget elementor-widget-text-editor col-md-12">
        <div class="elementor-widget-container" id="comments">
            @foreach ($collection->allComments() as $comment)
                @if ($comment->forCollection())
                    @include('profile.collection.comment',[
                        'collection' => $collection,
                        'comment' => $comment
                    ])
                @elseif ($comment->forCollectionItem())
                    @include('profile.collection.item.comment',[
                        'item' => $comment->commentable,
                        'comment' => $comment
                    ])
                @endif
            @endforeach
        </div>
    </div>

    @auth
        @include('profile.collection.send-comment', ['collection' => $collection])
    @endauth
@endisset