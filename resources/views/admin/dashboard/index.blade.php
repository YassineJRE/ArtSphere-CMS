@extends('admin.layouts.default')

@section('title')
    {{ __('admin-dashboard.views.index.title') }}
    @parent
@stop

@section('header_styles')

@stop

@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="dashboard-stat color-1">
                <div class="dashboard-stat-content">
                    <h4>{{ $number_artist_profiles }}</h4>
                    <span>{{ __('admin-dashboard.views.index.span.artists') }}</span>
                </div>
                <div class="dashboard-stat-icon">
                    <i class="im im-icon-Add-User"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="dashboard-stat color-3">
                <div class="dashboard-stat-content">
                    <h4>{{ $number_curator_profiles }}</h4>
                    <span>{{ __('admin-dashboard.views.index.span.curator') }}</span>
                </div>
                <div class="dashboard-stat-icon">
                    <i class="im im-icon-Suitcase"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="dashboard-stat color-2">
                <div class="dashboard-stat-content">
                    <h4>{{ $number_public_collector_profiles }}</h4>
                    <span>Total Public Collectors</span>
                    {{-- <span>{{ __('admin-dashboard.views.index.span.gallery') }}</span> --}}
                </div>
                <div class="dashboard-stat-icon">
                    <i class="im im-icon-Map2"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="dashboard-stat color-4">
                <div class="dashboard-stat-content">
                    <h4>{{ $number_members }}</h4>
                    <span>{{ __('admin-dashboard.views.index.span.public') }}</span>
                </div>
                <div class="dashboard-stat-icon">
                    <i class="im im-icon-Add-UserStar"></i>
                </div>
            </div>
        </div>
    </div>
@stop
