@isset($comment)
    <div class="elementor-text-editor elementor-clearfix">
        <blockquote>
            <a 
                class="comment-written-by"
                @if ($comment->byProfile())
                    href="{{ route('app.profiles.show',[
                        'profile' => $comment->writer_id,
                        'search' => request()->search,
                        'discover' => request()->discover,
                    ]) }}" 
                @elseif ($comment->byGroup())
                    href="{{ route('app.groups.show',[
                        'group' => $comment->writer_id,
                        'search' => request()->search,
                        'discover' => request()->discover,
                    ]) }}"
                @endif
            >{{ $comment->writer->getName() }}</a>
            {{ $comment->text }}
        </blockquote>
    </div>
@endisset
