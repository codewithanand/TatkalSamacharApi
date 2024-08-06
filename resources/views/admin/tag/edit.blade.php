@extends('layouts.admin')

@section('title', 'Edit Tag')

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
            <h1 class="h3 mb-2 text-gray-800">Tag</h1>
            <a class="btn btn-danger" href="{{ url('/admin/tags') }}">View Tags</a>
        </div>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Tag</h6>
            </div>
            <div class="card-body">
                <form action="{{ url('/admin/tags/' . $tag->id . '/update') }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Tag Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            placeholder="Tag Name" value="{{ $tag->name }}">
                        @error('name')
                            <span class="text-sm text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="name">Slug</label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug"
                            placeholder="Tag Name" value="{{ $tag->slug }}">
                        @error('slug')
                            <span class="text-sm text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection

@section('scripts')

@endsection
