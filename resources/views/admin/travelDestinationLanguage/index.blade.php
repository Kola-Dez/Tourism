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
                    <h3 class="card-title">Travel destinations languages Table</h3>
                </div>
                <!-- /.card-header -->
                <a href="{{ route('admin.travel_destination_languages.create') }}" class="btn btn-create">Create</a>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>name</th>
                            <th>translate name</th>
                            <th>code</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($travelDestinationsLanguages as $travelDestinationsLanguage)
                            <tr>
                                <td>{{ $travelDestinationsLanguage['id'] }}</td>
                                <td>{{ $travelDestinationsLanguage['name'] }}</td>
                                <td>{{ $travelDestinationsLanguage['translate_name'] }}</td>
                                <td>{{ $travelDestinationsLanguage['code'] }}</td>
                                <td>
                                    <a href="{{ route('admin.travel_destination_languages.show', $travelDestinationsLanguage['id']) }}" class="btn btn-outline-info">Show</a>
                                    <a href="{{ route('admin.travel_destination_languages.edit', $travelDestinationsLanguage['id']) }}" class="btn btn-outline-warning">Edit</a>
                                    <form action="{{ route('admin.travel_destination_languages.destroy', $travelDestinationsLanguage['id']) }}" method="POST" style="display:inline;">
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
