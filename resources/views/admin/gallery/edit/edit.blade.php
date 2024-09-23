@extends('admin.layouts.default')

@section('content')
    <style>
        .image-preview {
            display: flex;
            align-items: center;
        }

        .d-none {
            display: none;
        }
    </style>
    <style>
        .image-preview img {
            max-width: 400px;
            height: auto;
            margin-left: 10px;
        }

        * {
            margin: 0;
        }
        html, body {
            font-size: 18px;
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
            <h3 class="card-comment">Edit Group Tour</h3>
        </div>
        <a href="{{ route('admin.blogs.index') }}" class="btn btn-info card">Back</a>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ route('admin.blogs.update', $data['blog']['id']) }}" method="post" enctype="multipart/form-data" id="dynamicForm">
                @method('Patch')
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <!-- Title input -->
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Enter ..." value="{{ $data['blog']['title'] }}">
                            @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <!-- New file input field -->
                        <div class="form-group">
                            <label class="form-label @error('image') is-invalid @enderror">Upload Image</label>
                            @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <div class="d-flex align-items-center">
                                <input type="file" id="imageUpload" name="image" class="d-none">
                                <button type="button" class="btn btn-primary" id="uploadButton">
                                    <i class="fas fa-upload"></i> Choose Image
                                </button>
                                <div class="image-preview ms-3" id="imagePreview">
                                    <img src="{{ $data['blog']['image'] }}" alt="Image Preview" class="img-fluid" id="previewImage">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <!-- Description textarea -->
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="3" placeholder="Enter ...">{{ $data['blog']['description'] }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <!-- Country select -->
                        <div class="form-group">
                            <label>Выберите страну</label>
                            <select class="form-control @error('destination_id') is-invalid @enderror" id="country-select" name="destination_id">
                                <option value="">Select country</option>
                                @foreach($data['destinations'] as $destination)
                                    <option value="{{ $destination['id'] }}" {{ $data['blog']['destination'] !== $destination['id'] ? 'selected' : '' }}>{{ $destination['name'] }}</option>
                                @endforeach
                            </select>
                            @error('destination')
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
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Обработчик для загрузки одного изображения
            document.getElementById('uploadButton').addEventListener('click', function () {
                document.getElementById('imageUpload').click();
            });

            document.getElementById('imageUpload').addEventListener('change', function(event) {
                const file = event.target.files[0];
                const previewImage = document.getElementById('previewImage');
                const imagePreviewContainer = document.getElementById('imagePreview');
                const reader = new FileReader();

                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.classList.remove('d-none');
                    imagePreviewContainer.classList.remove('d-none');
                };

                if (file) {
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endsection
