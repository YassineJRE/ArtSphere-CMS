@extends('admin.layouts.default')

@section('title')
    {{ __('admin-gallery.views.index.title') }}
    @parent
@stop

@section('breadcrumbs')
    @include('admin.components.breadcrumbs', ['breadcrumbs' => [
        __('admin-gallery.views.index.breadcrumbs.home') => route('admin.dashboard'),
        __('admin-gallery.views.index.breadcrumbs.galleries')
    ]])
@stop

@section('header_styles')
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@stop

@section('content')
    <table class="table table-bordered yajra-datatable">
        <thead>
            <tr>
                <th>{{ __('admin-gallery.views.index.table.thead.tr.th.no') }}</th>
                <th>{{ __('admin-gallery.views.index.table.thead.tr.th.name') }}</th>
                <th>{{ __('admin-gallery.views.index.table.thead.tr.th.institution-type') }}</th>
                <th>{{ __('admin-gallery.views.index.table.thead.tr.th.status') }}</th>
                <th>{{ __('admin-gallery.views.index.table.thead.tr.th.actions') }}</th>
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
        ajax: "{{ route('admin.galleries.datatable', ['status' => request()->query('status')]) }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'institution_type', name: 'institution_type'},
            {data: 'status', name: 'status'},
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
