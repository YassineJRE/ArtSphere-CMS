@extends('layouts.main')

@section('title')
    403 Link expired
    @parent
@endsection

@section('page-title')
    403 Link expired
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        'Home' => route('app.home'),
        '403 Link expired'
    ]])
@stop

@section('content')
    <div class="col-md-12">
        <section id="not-found" class="center">
            <h2>403 <i class="fa fa-question-circle"></i></h2>
            <p>Link expired</p>
        </section>
    </div>
@stop
