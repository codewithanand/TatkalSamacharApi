@extends('layouts.admin')

@section('title', 'Edit SubCategory')

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
            <h1 class="h3 mb-2 text-gray-800">SubCategory</h1>
            <a class="btn btn-danger" href="{{ url('/admin/sub-categories') }}">View SubCategories</a>
        </div>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit SubCategory</h6>
            </div>
            <div class="card-body">
                <form action="{{ url('/admin/sub-categories/' . $subCategory->id . '/update') }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Select Category</label>
                        <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $category->id == $subCategory->category_id ? 'selected' : '' }}>{{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('name')
                            <span class="text-sm text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">SubCategory Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            placeholder="SubCategory Name" value="{{ $subCategory->name }}">
                        @error('name')
                            <span class="text-sm text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="name">Slug</label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug"
                            placeholder="SubCategory Slug" value="{{ $subCategory->slug }}">
                        @error('slug')
                            <span class="text-sm text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-dark">Update</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection

@section('scripts')

@endsection
