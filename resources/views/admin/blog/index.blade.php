@extends('admin.layouts.default')

@section('content')
    <style>
        .btn-create {
            background-color: #1bac1b;
            color: white;
        }
        .btn-create:hover {
            background-color: #189718;
            color: white;
        }
    </style>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Blogs Table</h3>
                    <div class="card-tools">
                        <form action="{{ route('admin.blogs.index') }}" method="GET">
                            <div class="input-group input-group-sm" style="width: 200px;">
                                <select class="form-control" id="category-select" name="table_search">
                                    <option value="">All</option>
                                    @foreach($data['destinations'] as $blog)
                                        <option value="{{ $blog['name_original'] }}">{{ $blog['name_original'] }}</option>
                                    @endforeach
                                </select>

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.card-header -->
                <a href="{{ route('admin.blogs.create') }}" class="btn btn-create">Create</a>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Destination</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data['blogs'] as $blog)
                            <tr>
                                <td>{{ $blog['id'] }}</td>
                                <td>{{ $blog['title'] }}</td>
                                <td>{{ $blog['destination'] }}</td>
                                <td>{{ $blog['description'] }}</td>
                                <td>
                                    <img src="{{ asset($blog['image']) }}" alt="{{ $blog['title'] }}" width="200">
                                </td>
                                <td>
                                    <a href="{{ route('admin.blogs.show', $blog['id']) }}" class="btn btn-outline-info">Show</a>
                                    <a href="{{ route('admin.blogs.edit', $blog['id']) }}" class="btn btn-outline-warning">Edit</a>
                                    <form action="{{ route('admin.blogs.destroy', $blog['id']) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger">Delete</button>
                                    </form>
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
