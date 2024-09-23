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
                    <h3 class="card-title">Private Tours Table</h3>

                    <div class="card-tools">
                        <form action="{{ route('admin.private_tours.index') }}" method="GET">
                            <div class="input-group input-group-sm" style="width: 300px;">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search" value="{{ request('table_search') }}">

                                <input type="date" name="departing_date" class="form-control float-right" placeholder="Departing Date" value="">

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
                <a href="{{ route('admin.private_tours.create') }}" class="btn btn-create">Create</a>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Destination</th>
                            <th>Travel Destination</th>
                            <th>Category</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Departing</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tours as $tour)
                            <tr>
                                <td>{{ $tour['id'] }}</td>
                                <td>{{ $tour['destination'] }}</td>
                                <td>{{ $tour['travel_destination'] }}</td>
                                <td>{{ $tour['category'] }}</td>
                                <td>{{ $tour['title'] }}</td>
                                <td>
                                    <img src="{{ asset($tour['image']) }}" alt="{{ $tour['title'] }}" width="200">
                                </td>
                                <td>{{ $tour['departing'] }}</td>
                                <td>
                                    <a href="{{ route('admin.private_tours.show', $tour['id']) }}" class="btn btn-outline-info">Show</a>
                                    <a href="{{ route('admin.private_tours.edit', $tour['id']) }}" class="btn btn-outline-warning">Edit</a>
                                    <form action="{{ route('admin.private_tours.destroy', $tour['id']) }}" method="POST" style="display:inline;">
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
