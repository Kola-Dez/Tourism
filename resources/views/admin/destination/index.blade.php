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
                    <h3 class="card-title">Destinations Table</h3>
                </div>
                <!-- /.card-header -->
                <a href="{{ route('admin.destinations.create') }}" class="btn btn-create">Create</a>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>name</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($destinations as $destination)
                            <tr>
                                <td>{{ $destination['id'] }}</td>
                                <td>{{ $destination['name'] }}</td>
                                <td>
                                    <img src="{{ asset($destination['image']) }}" alt="{{ $destination['name'] }}" style="max-width: 200px">
                                </td>
                                <td>
                                    <a href="{{ route('admin.destinations.show', $destination['id']) }}" class="btn btn-outline-info">Show</a>
                                    <a href="{{ route('admin.destinations.edit', $destination['id']) }}" class="btn btn-outline-warning">Edit</a>
                                    <form action="{{ route('admin.destinations.destroy', $destination['id']) }}" method="POST" style="display:inline;">
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
