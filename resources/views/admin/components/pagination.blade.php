@isset($results)
    @php $link_limit = 7 @endphp

    @if ($results->lastPage() > 1)
        <div class="pagination-container margin-top-30 margin-bottom-0">
            <nav class="pagination">
                <ul class="page-numbers">
                    @if ($results->currentPage() != 1)
                        <li>
                            <a class="prev page-numbers" href="{{ $results->previousPageUrl() }}">
                                <i class="sl sl-icon-arrow-left"></i>
                            </a>
                        </li>
                    @endif

                    @if ($results->currentPage() > 5 && $results->lastPage() > 7)
                        <li>
                            <a class="page-numbers" href="{{ $results->url(1) }}">1</a>
                        </li>
                        <li>
                            <a class="page-numbers" href="{{ $results->url(2) }}">2</a>
                        </li>
                        <li>...</li>
                    @endif

                    @for ($i = 1; $i <= $results->lastPage(); $i++)
                        @php
                            $half_total_links = floor($link_limit / 2);
                            $from = $results->currentPage() - $half_total_links;
                            $to = $results->currentPage() + $half_total_links;

                            if ($results->currentPage() < $half_total_links) {
                                $to += $half_total_links - $results->currentPage();
                            }

                            if ($results->lastPage() - $results->currentPage() < $half_total_links) {
                                $from -= $half_total_links - ($results->lastPage() - $results->currentPage()) - 1;
                            }
                        @endphp

                        @if ($from < $i && $i < $to)
                            @if ($results->currentPage() == $i)
                                <li>
                                    <span aria-current="page" class="page-numbers current">{{ $i }}</span>
                                </li>
                            @else
                                <li>
                                    <a class="page-numbers" href="{{ $results->url($i) }}">{{ $i }}</a>
                                </li>
                            @endif
                        @endif
                    @endfor

                    @if (($results->lastPage() - 1) > $to)
                        <li>...</li>
                        <li>
                            <a class="page-numbers" href="{{ $results->url($results->lastPage() -1) }}">{{ $results->lastPage() - 1 }}</a>
                        </li>
                        <li>
                            <a class="page-numbers" href="{{ $results->url($results->lastPage()) }}">{{ $results->lastPage() }}</a>
                        </li>
                    @endif

                    @if ($results->hasMorePages())
                        <li>
                            <a class="next page-numbers" href="{{ $results->nextPageUrl() }}">
                                <i class="sl sl-icon-arrow-right"></i>
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    @endif
@endisset
