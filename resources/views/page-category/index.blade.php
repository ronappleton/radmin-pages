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
        <table class="table table-bordered" id="users">
            <thead>
            <tr>
                <th>Name</th>
                <th>Action</th>
            </tr>
            </thead>
        </table>
    </div>

@stop

<script>
    $(function () {
        $('#users').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ url('admin/ajax-resources/allUsers') }}',
            columns: [
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'created_at', name: 'created_at'},
                {data: 'updated_at', name: 'updated_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    });
</script>