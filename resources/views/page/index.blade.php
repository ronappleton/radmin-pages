@extends('radmin::layouts.master')

@section('title', 'Pages')

@section('content_header')
    <h1>All Pages</h1>
@stop

@section('content')
    <p>
        <a href="{{ route('page.create') }}" class="btn btn-sm btn-success">Create New Page</a>
    </p>
    <div class="form-group">
        <table class="table table-bordered" id="pages">
            <thead>
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Action</th>
            </tr>
            </thead>
        </table>
    </div>

@stop

@push('scripts')
    <script>
        $(function () {
            $('#pages').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url('admin/page/ajax-resources/pagesAll') }}',
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'category_id', name: 'category_id'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });
    </script>
@endpush