@extends('layouts.admin')

@section('title', 'Users')

@section('styles')
    <link rel="stylesheet" href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="container-fluid">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> {{ session('error') }}
            </div>
        @endif

        <!-- Page Heading -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 mb-2 text-gray-800">User</h1>
            <a class="btn btn-danger" href="{{ url('/admin/users/create') }}">Add User</a>
        </div>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Users</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->role == 'admin')
                                            <span class="badge bg-danger text-white">{{ $user->role }}</span>
                                        @elseif ($user->role == 'writer')
                                            <span class="badge bg-success text-white">{{ $user->role }}</span>
                                        @else
                                            <span class="badge bg-dark text-white">{{ $user->role }}</span>
                                        @endif

                                    </td>
                                    <td>
                                        <a class="btn btn-info" href="{{ url('/admin/users/' . $user->id . '/edit') }}">
                                            <i class="far fa-edit"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn btn-danger"
                                            onclick="return confirm('Are you sure want to delete this user?')"
                                            href="{{ url('/admin/users/' . $user->id . '/delete') }}">
                                            <i class="far fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('admin/js/demo/datatables-demo.js') }}"></script>

@endsection
