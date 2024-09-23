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
            <h3 class="card-comment">Create Travel Destination</h3>
        </div>
        <a href="{{ route('admin.travel_destinations.index') }}" class="btn btn-info card">Back</a>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ route('admin.travel_destinations.store') }}" method="post" enctype="multipart/form-data" id="dynamicForm">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <!-- Name input -->
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter ..." value="{{ old('name') }}">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                    </div>

                    <div class="col-sm-4">
                        <!-- Upload Image -->
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
                                    <img src="" alt="Image Preview" class="img-fluid d-none" id="previewImage">
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
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="3" placeholder="Enter ...">{{ old('description') }}</textarea>
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
                                    <option value="{{ $destination['id'] }}" {{ old('destination_id') == $destination['id'] ? 'selected' : '' }}>{{ $destination['name'] }}</option>
                                @endforeach
                            </select>
                            @error('destination_id')
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
