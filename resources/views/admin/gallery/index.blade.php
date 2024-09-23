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
                    <h3 class="card-title">Galleries Table</h3>
                </div>
                <!-- /.card-header -->
                <a href="{{ route('admin.galleries.create') }}" class="btn btn-create">Create</a>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $gallery)
                            <tr>
                                <td>{{ $gallery['id'] }}</td>
                                <td>
                                    <img src="{{ asset($gallery['image']) }}" alt="image{{ $gallery['id'] }}" width="200">
                                </td>
                                <td>
                                    <a href="{{ route('admin.galleries.show', $gallery['id']) }}" class="btn btn-outline-info">Show</a>
                                    <form action="{{ route('admin.galleries.destroy', $gallery['id']) }}" method="POST" style="display:inline;">
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
