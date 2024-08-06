@extends('layouts.admin')

@section('title', 'Live TV')

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
            <h1 class="h3 mb-2 text-gray-800">Live TV</h1>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add LiveTV</h6>
            </div>
            <div class="card-body">
                <form action="{{ url('/admin/live-tv/create') }}" method="POST" class="">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title">
                    </div>
                    <div class="form-group mb-3">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control" name="slug">
                    </div>
                    <div class="form-group mb-3">
                        <label for="live_url">Live URL</label>
                        <input type="text" class="form-control" name="live_url">
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="d-block">Where to show</label>
                        <label for="homepage">
                            <input type="checkbox" name="homepage">
                            Homepage
                        </label>
                        <label for="sidebar">
                            <input type="checkbox" name="sidebar">
                            Sidebar
                        </label>
                        <label for="breaking">
                            <input type="checkbox" name="breaking">
                            Breaking
                        </label>
                    </div>
                    <button type="submit" class="btn btn-success">Add</button>
                </form>
            </div>
        </div>

        <!-- DataTables Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All LiveTV</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Homepage</th>
                                <th>Sidebar</th>
                                <th>Breaking</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($live_tvs as $live_tv)
                                <tr>
                                    <td>{{ $live_tv->title }}</td>
                                    <td>
                                        @if ($live_tv->homepage == 1)
                                            <span class="badge bg-primary text-white">Showing</span>
                                        @else
                                            <span class="badge bg-secondary text-white">Not Showing</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($live_tv->sidebar == 1)
                                            <span class="badge bg-primary text-white">Showing</span>
                                        @else
                                            <span class="badge bg-secondary text-white">Not Showing</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($live_tv->breaking == 1)
                                            <span class="badge bg-primary text-white">Showing</span>
                                        @else
                                            <span class="badge bg-secondary text-white">Not Showing</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-danger"
                                            onclick="return confirm('Are you sure want to remove this live tv?')"
                                            href="{{ url('/admin/live-tv/' . $live_tv->id . '/remove') }}">
                                            <i class="fas fa-ban"></i>
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
