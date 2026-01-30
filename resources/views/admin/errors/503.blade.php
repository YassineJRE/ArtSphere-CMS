@extends('layouts/without-header')

@section('title')
    {{ __('admin-errors.views.503.title') }}
    @parent
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <section id="not-found" class="center">
                    <img src="{{ asset('img/logo_foncer.png') }}">
                    {{-- <h2>503</h2> --}}
                    {{-- <p>Maintenance Mode</p> --}}
                </section>
            </div>
        </div>
    </div>
@stop
