@isset($item)
    {{-- <div class="elementor-element elementor-widget elementor-widget-listeo-headline">
        <div class="elementor-widget-container">
            <h4 style="text-align:left;" 
                class="headline headline-box "
            >{{ __('profile.views.comments.title') }}</h4>
        </div>
    </div> --}}

    <div class="elementor-element elementor-widget elementor-widget-text-editor col-md-12">
        <div class="elementor-widget-container" id="comments">
            @foreach ($item->comments as $comment)
                @include('profile.collection.item.comment',[
                    'item' => $item,
                    'comment' => $comment
                ])            
            @endforeach
        </div>
    </div>

    @auth
        @include('profile.collection.item.send-comment', ['item' => $item])
    @endauth
@endisset