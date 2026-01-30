@extends('admin.layouts.default')

@section('title')
    {{ __('admin-review.views.index.title') }}
    @parent
@stop

@section('breadcrumbs')
    @include('admin.components.breadcrumbs', ['breadcrumbs' => [
        __('admin-review.views.index.breadcrumbs.home') => route('admin.dashboard'),
        __('admin-review.views.index.breadcrumbs.reviews')
    ]])
@stop

@section('header_styles')
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@stop

@section('content')
    @can(PrivilegeAdmin::WEB_REVIEW_CREATE)
        <div class="row margin-bottom-20">
            <div class="col-md-12">
                <div class="pull-left">
                    <a href="{{ route('admin.reviews.create') }}" class="button">
                        {{ __('admin-review.views.index.button.new') }} <i class="sl sl-icon-plus"></i>
                    </a>
                </div>
            </div>
        </div>
    @endcan

    <table class="table table-bordered yajra-datatable">
        <thead>
            <tr>
                <th>{{ __('admin-review.views.index.table.thead.tr.th.no') }}</th>
                <th>{{ __('admin-review.views.index.table.thead.tr.th.from') }}</th>
                <th>{{ __('admin-review.views.index.table.thead.tr.th.to') }}</th>
                <th>{{ __('admin-review.views.index.table.thead.tr.th.ad-id') }}</th>
                <th>{{ __('admin-review.views.index.table.thead.tr.th.message') }}</th>
                <th>{{ __('admin-review.views.index.table.thead.tr.th.is-positive') }}</th>
                <th>{{ __('admin-review.views.index.table.thead.tr.th.actions') }}</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
@stop

@section('app_scripts')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
    $(function () {

        var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.reviews.datatable') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'from', name: 'from'},
                {data: 'to', name: 'to'},
                {data: 'ad_id', name: 'ad_id'},
                {data: 'message', name: 'message'},
                {data: 'is_positive', name: 'is_positive'},
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                },
            ]
        }).on( 'draw.dt', function () {
        $('.popup-delete-row').magnificPopup({
            type: 'inline',
            fixedContentPos: false,
            fixedBgPos: true,
            overflowY: 'auto',
            closeBtnInside: true,
            preloader: false,
            midClick: true,
            removalDelay: 300,
            mainClass: 'my-mfp-zoom-in'
        });
    });

});
</script>
@stop
