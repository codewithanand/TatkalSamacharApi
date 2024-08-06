@extends('layouts.admin')

@section('title', 'Create User')

@section('styles')
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
            <a class="btn btn-danger" href="{{ url('/admin/users') }}">View Users</a>
        </div>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Create User</h6>
            </div>
            <div class="card-body">
                <form action="{{ url('/admin/users/create') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            placeholder="Full Name">
                        @error('name')
                            <span class="text-sm text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            placeholder="Email Address">
                        @error('email')
                            <span class="text-sm text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" class="form-control @error('password') is-invalid @enderror" name="password"
                            placeholder="Password">
                        @error('password')
                            <span class="text-sm text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="role">Select Role</label>
                        <select name="role" class="form-control @error('role') is-invalid @enderror">
                            <option value="admin">Admin</option>
                            <option value="writer">Writer</option>
                            <option value="reader">Reader</option>
                        </select>
                        @error('role')
                            <span class="text-sm text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-dark">Create</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection

@section('scripts')

@endsection
