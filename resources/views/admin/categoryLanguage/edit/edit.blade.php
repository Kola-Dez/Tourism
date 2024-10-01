@extends('admin.layouts.default')

@section('content')
    <style>
        .image-preview {
            display: flex;
            align-items: center;
        }
    </style>
    <style>
        * {
            margin: 0;
        }
        html, body {
            font-size: 18px;
        }
        img {
            margin: 20px;
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
            <h3 class="card-comment">Edit language for Category: {{ $data['categoryTranslation']['title'] }}</h3>
        </div>
        <a href="{{ route('admin.category_languages.index') }}" class="btn btn-info card">Back</a>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ route('admin.category_languages.update', $data['categoryTranslation']['id']) }}" method="post" enctype="multipart/form-data" id="dynamicForm">
                @method('Patch')
                @csrf


                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Translate title</label>
                            <input type="text" class="form-control @error('translate_title') is-invalid @enderror" name="translate_title" placeholder="Enter ..." value="{{ $data['categoryTranslation']['translate_title'] !== null ? $data['categoryTranslation']['translate_title'] : old('title') }}">
                            @error('translate_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>Select language</label>
                            <select class="form-control @error('language_id') is-invalid @enderror" id="category-select" name="language_id">
                                @foreach($data['languages'] as $languages)
                                    <option value="{{ $languages['id'] }}" {{ $data['categoryTranslation']['code'] == $languages['code'] ? 'selected' : '' }}>{{ $languages['code'] }}</option>
                                @endforeach
                            </select>
                            @error('language_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>Select country</label>
                            <select class="form-control @error('category_id') is-invalid @enderror" id="category-select" name="category_id">
                                @foreach($data['categories'] as $category)
                                    <option value="{{ $category['id'] }}" {{ $data['categoryTranslation']['title'] == $category['title'] ? 'selected' : '' }}>{{ $category['title'] }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
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
                            <textarea class="form-control @error('translate_description') is-invalid @enderror" name="translate_description" rows="3" placeholder="Enter ...">{{ $data['categoryTranslation']['translate_description'] }}</textarea>
                            @error('translate_description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-warning">Edite</button>
            </form>
        </div>
    </div>
@endsection
