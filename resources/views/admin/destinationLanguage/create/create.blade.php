@extends('admin.layouts.default')

@section('content')
    <style>
        .image-preview {
            display: flex;
            align-items: center;
        }

        .image-preview img {
            max-width: 200px;
            height: auto;
            margin-left: 10px;
        }

        .d-none {
            display: none;
        }

        * {
            margin: 0;
        }
        html, body {
            font-size: 18px;
        }
        img {
            max-width: 700px;
            max-height: 500px;
        }
        h1 {
            text-align: center;
            margin-bottom: 40px;
        }
        button:hover {
            background: orangered;
        }
        button:active {
            background: black;
            color: white;
        }
    </style>
    <div class="card card-green">
        <div class="card-header">
            <h3 class="card-comment">Create Language for Destination</h3>
        </div>
        <a href="{{ route('admin.destination_languages.index') }}" class="btn btn-info card">Back</a>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ route('admin.destination_languages.store') }}" method="post" enctype="multipart/form-data" id="dynamicForm">
                @csrf
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Translate name</label>
                            <input type="text" class="form-control @error('translate_name') is-invalid @enderror" name="translate_name" placeholder="Enter ..." value="{{ old('translate_name') }}">
                            @error('translate_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <!-- Category select -->
                        <div class="form-group">
                            <label>Select country</label>
                            <select class="form-control @error('category_id') is-invalid @enderror" id="category-select" name="destination_id">
                                <option value="">country</option>
                                @foreach($data['destinations'] as $destination)
                                    <option value="{{ $destination['id'] }}" {{ old('destination_id') == $destination['id'] ? 'selected' : '' }}>{{ $destination['name'] }}</option>
                                @endforeach
                            </select>
                            @error('destination')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <!-- Category select -->
                        <div class="form-group">
                            <label>Select language</label>
                            <select class="form-control @error('category_id') is-invalid @enderror" id="category-select" name="language_id">
                                <option value="">language</option>
                                @foreach($data['languages'] as $language)
                                    <option value="{{ $language['id'] }}" {{ old('language_id') == $language['id'] ? 'selected' : '' }}>{{ $language['name'] }}</option>
                                @endforeach
                            </select>
                            @error('language')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Translate description</label>
                            <textarea class="form-control @error('translate_description') is-invalid @enderror" name="translate_description" rows="3" placeholder="Enter ...">{{ old('translate_description') }}</textarea>
                            @error('translate_description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
@endsection
