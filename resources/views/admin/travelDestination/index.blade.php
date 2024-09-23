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
                    <h3 class="card-title">Travel Destinations Table</h3>

                    <div class="card-tools">
                        <form action="{{ route('admin.travel_destinations.index') }}" method="GET">
                            <div class="input-group input-group-sm" style="width: 300px;">
                                <select class="form-control" id="category-select" name="table_search">
                                    <option value="">All</option>
                                    @foreach($data['destinations'] as $blog)
                                        <option value="{{ $blog['code'] }}">{{ $blog['code'] }}</option>
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
                <a href="{{ route('admin.travel_destinations.create') }}" class="btn btn-create">Create</a>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Destination</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data['travelDestinations'] as $travelDestination)
                            <tr>
                                <td>{{ $travelDestination['id'] }}</td>
                                <td>{{ $travelDestination['name'] }}</td>
                                <td>{{ $travelDestination['destination'] }}</td>
                                <td>
                                    <img src="{{ asset($travelDestination['image']) }}" alt="{{ $travelDestination['name'] }}" style="max-width: 200px">
                                </td>
                                <td>
                                    <a href="{{ route('admin.travel_destinations.show', $travelDestination['id']) }}" class="btn btn-outline-info">Show</a>
                                    <a href="{{ route('admin.travel_destinations.edit', $travelDestination['id']) }}" class="btn btn-outline-warning">Edit</a>
                                    <form action="{{ route('admin.travel_destinations.destroy', $travelDestination['id']) }}" method="POST" style="display:inline;">
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
