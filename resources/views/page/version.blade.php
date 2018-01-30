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
                <th>Updated At</th>
                <th>Version</th>
                <th>Published</th>
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
                ajax: '{{ url('admin/page/ajax-resources/versions', ['name' => $name]) }}',
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'category_name', name: 'category_name'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'version', name: 'version'},
                    {data: 'published', name: 'published'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });
    </script>
@endpush