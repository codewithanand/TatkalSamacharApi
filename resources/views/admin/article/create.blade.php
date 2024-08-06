@extends('layouts.admin')

@section('title', 'Create Article')

@section('styles')
    <link rel="stylesheet" href="{{ asset('summernote/summernote.css') }}">
    <style>
        .file-preview {
            display: flex;
            flex-wrap: wrap;
        }

        .file-preview img,
        .file-preview video {
            max-width: 150px;
            margin: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .file-preview video {
            max-height: 150px;
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>
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
        <div class="row mb-3">
            <div class="col-md-6">
                <h1 class="h3 mb-2 text-gray-800">Article</h1>
            </div>
            <div class="col-md-6 d-lg-flex justify-content-lg-end gap-lg-2">
                <span>
                    <a class="btn btn-danger" href="{{ url('/admin/articles') }}">View Articles</a>
                </span>
            </div>
        </div>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Create Article</h6>
            </div>
            <div class="card-body">
                <form action="{{ url('/admin/articles/create') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    name="title" placeholder="Title" value="{{ old('title') }}">
                                @error('title')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="name">Slug</label>
                                <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                    name="slug" placeholder="Slug" {{ old('slug') }}>
                                @error('slug')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <textarea id="summernote" name="content" {{ old('content') }} class="@error('content') is-invalid @enderror"></textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="category">Select Category</label>
                                <select name="category" class="form-control @error('category') is-invalid @enderror">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="tag">Select Tag</label>
                                <select class="form-control tags-select" name="tags[]" multiple="multiple">
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->slug }}">{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                                @error('tag')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 border p-3">
                            <label for="" class="mb-3">Add Media</label>
                            <div class="file-preview" id="file-preview"></div>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="flex-1">
                                    <input type="file" id="files" name="files[]"
                                        class="form-control @error('files') is-invalid @enderror" multiple
                                        accept="image/*,video/*">
                                </div>
                                <div>
                                    <button type="button" class="btn btn-outline-secondary" id="clear-files">Clear</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-dark">Create</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script src="{{ asset('summernote/summernote.js') }}"></script>
    <script>
        $('#summernote').summernote({
            placeholder: 'Write content here...',
            tabsize: 2,
            height: 300
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.tags-select').select2({
                placeholder: 'Select tags',
                tags: true,
                tokenSeparators: [',']
            });
        });
    </script>

    <script>
        document.getElementById('files').addEventListener('change', function(event) {
            const files = event.target.files;
            const previewContainer = document.getElementById('file-preview');
            previewContainer.innerHTML = '';

            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    if (file.type.startsWith('image/')) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        previewContainer.appendChild(img);
                    } else if (file.type.startsWith('video/')) {
                        const video = document.createElement('video');
                        video.src = e.target.result;
                        video.controls = true;
                        previewContainer.appendChild(video);
                    }
                };
                reader.readAsDataURL(file);
            });
        });
        document.getElementById('clear-files').addEventListener('click', function() {
            const fileInput = document.getElementById('files');
            fileInput.value = '';
            const previewContainer = document.getElementById('file-preview');
            previewContainer.innerHTML = '';
        });
    </script>
@endsection
