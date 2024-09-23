@extends('admin.layouts.default')

@section('content')
    <style>
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }
    </style>
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
            max-width: 200px;
            height: auto;
            margin-left: 10px;
        }

        * {
            margin: 0;
        }
        html, body {
            font-size: 18px;
        }
        .container {
            max-width: 700px;
            margin: 30px;
            padding: 30px;
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
        .slider {
            width: 700px;
            height: 500px;
            border: 2px solid black;
            margin: 30px auto;
            border-radius: 10%;
            overflow: hidden;
            position: relative;
        }
        .slider-line {
            height: 500px;
            display: flex;
            position: absolute;
            left: 0;
            transition: all ease 1s;
        }
    </style>
    <div class="card card-green">
        <div class="card-header">
            <h3 class="card-comment">Edit Travel Destination: {{ $data['travelDestination']['name'] }}</h3>
        </div>
        <a href="{{ route('admin.travel_destinations.index') }}" class="btn btn-info card">Back</a>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ route('admin.travel_destinations.update', $data['travelDestination']['id']) }}" method="post" enctype="multipart/form-data" id="dynamicForm">
                @method('Patch')
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <!-- Title input -->
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter ..." value="{{ $data['travelDestination']['name'] }}">
                            @error('name')
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
                                    <img src="{{ $data['travelDestination']['image'] }}" alt="Image Preview" class="img-fluid" id="previewImage">
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
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="3" placeholder="Enter ...">{{ $data['travelDestination']['description'] }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4" id="content">
                        <div class="form-group">
                            <label>Destination</label>
                            <select class="form-control" name="destination_id">
                                <option value="">Select Country</option>
                                @foreach($data['destinations'] as $destination)
                                    <option value="{{ $destination['id'] }}" {{$data['travelDestination']['destination_id'] === $destination['id'] ? 'selected' : ''}}>{{ $destination['name'] }}</option>
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
