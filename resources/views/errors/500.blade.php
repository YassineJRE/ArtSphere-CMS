@extends('layouts.main')

@section('title')
    500 Not found
    @parent
@endsection

@section('page-title')
    500 Not found
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        'Home' => route('app.home'),
        '500 Not found'
    ]])
@stop

@section('content')
    <div class="col-md-12">
        <section id="not-found" class="center">
            <h2>500 <i class="fa fa-question-circle"></i></h2>
            <p>We're sorry, but the page you were looking for doesn't exist.</p>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <form role="search"
                        method="get"
                        class="form-search"
                        action="{{ route('app.research') }}"
                    >
                        <div class="main-search-input gray-style margin-top-50 margin-bottom-10">
                            <div class="main-search-input-item">
                                <input
                                    type="text"
                                    id="search-field"
                                    class="search-field"
                                    name="search"
                                    value="{{ request()->search }}"
                                    placeholder="What are you looking for?"
                                >
                            </div>
                            <button type="submit" class="button">Search</button>
                        </div>
                    </form>              
                </div>
            </div>
        </section>
    </div>
@stop
