@extends('layouts.main')

@section('main')
<div class="container mt-5 mb-5">
    <h1 class="text-center mb-4">All Users</h1>
    <div class="table-responsive">
        <table id="usersTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>University</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td><a href="{{ url('/profile/' . $user->id) }}">{{ $user->name }}</a></td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->university }}</td>
                    <td>{{ ucfirst($user->role) }}</td>
                    <td>
                        @if ($user->role === 'admin')
                        <form action="/admin/user/remove/admin/{{$user->id}}" method="GET" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Remove Admin</button>
                        </form>
                        @else
                        <form action="/admin/user/make/admin/{{$user->id}}" method="GET" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Make Admin</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Include jQuery and DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- DataTables Initialization -->
<script>
    $(document).ready(function() {
        $('#usersTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true
        });
    });
</script>

<!-- Include DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endsection