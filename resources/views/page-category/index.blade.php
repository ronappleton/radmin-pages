@extends(config('radmin-users.layout_file'))

@section('title', 'Pages')

@section('content_header')
    <h1>Page Categories</h1>
@stop

@section('content')
    <p>
        <a href="{{ route('users.create') }}" class="btn btn-sm btn-success">Create New Page Category</a>
    </p>
    <div class="form-group">
        <table class="table table-bordered" id="page-categories">
            <thead>
            <tr>
                <th>Name</th>
                <th>Action</th>
            </tr>
            </thead>
        </table>
    </div>

@stop

@push('scripts')
    <script>
        $(function () {
            $('#page-categories').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url('admin/page/ajax-resources/pageCategoriesAll') }}',
                columns: [
                    {data: 'category', name: 'category'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });
    </script>
@endpush