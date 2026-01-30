@if(method_exists($items, 'hasPages') && $items->hasPages())
    @php
        $queryParams = request()->query();
        $pageParam = $items->getPageName();
        $baseUrl = route('app.research.carousel', ['type' => $type]);
    @endphp

    <div class="pagination-container">
        <div class="modern-pagination-wrapper">
            {{-- Previous Page --}}
            {{-- @if($items->currentPage() > 1)
                @php
                    $prevUrl = $baseUrl . '?' . http_build_query(array_merge($queryParams, [
                        $pageParam => $items->currentPage() - 1,
                    ]));
                @endphp
                <a href="{{ $prevUrl }}"
                   class="pagination-btn prev-btn ajax-carousel-link"
                   data-type="{{ $type }}">«</a>
            @endif --}}

            {{-- Page links --}}
            @for ($i = 1; $i <= $items->lastPage(); $i++)
                @php
                    $pageUrl = $baseUrl . '?' . http_build_query(array_merge($queryParams, [
                        $pageParam => $i,
                    ]));
                @endphp

                @if($i === $items->currentPage())
                    <span class="pagination-btn current-btn">{{ $i }}</span>
                @elseif(
                    $i === 1 ||
                    $i === $items->lastPage() ||
                    abs($i - $items->currentPage()) <= 1
                )
                    <a href="{{ $pageUrl }}"
                       class="pagination-btn page-btn ajax-carousel-link"
                       data-type="{{ $type }}">{{ $i }}</a>
                @elseif(
                    $i === 2 && $items->currentPage() > 4 ||
                    $i === $items->lastPage() - 1 && $items->currentPage() < $items->lastPage() - 3
                )
                    <span class="pagination-btn dots">...</span>
                @endif
            @endfor

            {{-- Next Page --}}
            {{-- @if($items->currentPage() < $items->lastPage())
                @php
                    $nextUrl = $baseUrl . '?' . http_build_query(array_merge($queryParams, [
                        $pageParam => $items->currentPage() + 1,
                    ]));
                @endphp
                <a href="{{ $nextUrl }}"
                   class="pagination-btn next-btn ajax-carousel-link"
                   data-type="{{ $type }}">»</a>
            @endif --}}
        </div>
    </div>
@endif
