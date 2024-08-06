@extends('layouts.admin')

@section('title', 'Create Category')

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
            <h1 class="h3 mb-2 text-gray-800">Category</h1>
            <a class="btn btn-danger" href="{{ url('/admin/categories') }}">View Categories</a>
        </div>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Create Category</h6>
            </div>
            <div class="card-body">
                <form action="{{ url('/admin/categories/create') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Category Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            placeholder="Category Name">
                        @error('name')
                            <span class="text-sm text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="name">Slug</label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug"
                            placeholder="Category Name">
                        @error('slug')
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
