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
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Categories Table</h3>
                </div>
                <!-- /.card-header -->
                <a href="{{ route('admin.categories.create') }}" class="btn btn-create">Create</a>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $category['id'] }}</td>
                                <td>{{ $category['title'] }}</td>
                                <td>
                                    <img src="{{ asset($category['image']) }}" alt="{{ $category['title'] }}" width="200">
                                </td>
                                <td>
                                    <a href="{{ route('admin.categories.show', $category['slug']) }}" class="btn btn-outline-info">Show</a>
                                    <a href="{{ route('admin.categories.edit', $category['id']) }}" class="btn btn-outline-warning">Edit</a>
                                    <form action="{{ route('admin.categories.destroy', $category['id']) }}" method="POST" style="display:inline;">
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
