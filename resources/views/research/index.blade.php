@extends('layouts.main')

@section('header_styles')
    <style>
        .loading-spinner {
            text-align: center;
            padding: 30px;
            font-size: 18px;
            color: #999;
        }
        [class^="carousel-container-"] {
            transition: min-height 0.2s ease;
        }
    </style>
@endsection

@section('title')
    {{ __('research.views.index.title.research') }}
    @parent
@endsection

@section('page-title')
    {{ __('research.views.index.page-title.search-result', ['search' => $search]) }}
@stop

@section('breadcrumbs')
@stop

@section('content')
    <div class="col-md-12">
        <div class="carousel-container-profiles">
            @include('components.carousels.profiles', ['profiles' => $profiles])
        </div>
        <div class="carousel-container-exhibits">
            @include('components.carousels.exhibits', ['exhibits' => $exhibits])
        </div>
        <div class="carousel-container-artworks">
            @include('components.carousels.artworks', ['artworks' => $artworks])
        </div>
        <div class="carousel-container-websites">
            @include('components.carousels.websites', ['websites' => $websites])
        </div>
        <div class="carousel-container-collections">
            @include('components.carousels.collections', ['collections' => $collections])
        </div>
    </div>
@stop

@section('app_scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.body.addEventListener('click', function (e) {
                const link = e.target.closest('.ajax-carousel-link');
                if (!link) return;

                e.preventDefault();

                const url = link.getAttribute('href');
                const type = link.dataset.type;
                const container = document.querySelector(`.carousel-container-${type}`);

                if (!container) return;

                const originalHeight = container.offsetHeight;
                container.style.minHeight = originalHeight + 'px';

                container.innerHTML = '<div class="loading-spinner">Loading...</div>';

                fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(res => {
                    if (!res.ok) throw new Error('Network response was not ok');
                    return res.text();
                })
                .then(html => {
                    container.innerHTML = html;
                    container.style.minHeight = '';
                })
                .catch(err => {
                    console.error('AJAX error:', err);
                    container.innerHTML = '<div class="loading-spinner">Error loading content.</div>';
                    container.style.minHeight = '';
                });
            });
        });
    </script>
@stop
