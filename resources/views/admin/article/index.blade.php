@extends('layouts.admin')

@section('title', 'Articles')

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
            <h1 class="h3 mb-2 text-gray-800">Article</h1>
            <a class="btn btn-danger" href="{{ url('/admin/articles/create') }}">Add Article</a>
        </div>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Articles</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Delete</th>
                                <th>Edit</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articles as $article)
                                <tr>
                                    <td>{{ Str::limit($article->title, 40, '...') }}</td>
                                    <td>{{ $article->subCategory->name }}</td>

                                    <td>
                                        <a class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure want to delete this article?')"
                                            href="{{ url('/admin/articles/' . $article->id . '/delete') }}">
                                            <i class="far fa-trash-alt"></i> Delete
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-info"
                                            href="{{ url('/admin/articles/' . $article->id . '/edit') }}">
                                            <i class="far fa-edit"></i> Edit
                                        </a>
                                    </td>
                                    <td>
                                        @if ($article->status == 'draft')
                                            <a class="btn btn-sm btn-success"
                                                onclick="return confirm('Are you sure want to publish this article?')"
                                                href="{{ url('/admin/articles/' . $article->id . '/publish') }}">
                                                <i class="fas fa-share"></i> Publish
                                            </a>
                                        @else
                                            <a class="btn btn-sm btn-warning"
                                                onclick="return confirm('Are you sure want to unpublish this article?')"
                                                href="{{ url('/admin/articles/' . $article->id . '/unpublish') }}">
                                                <i class="far fa-pause-circle"></i> Unpublish
                                            </a>
                                        @endif
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
