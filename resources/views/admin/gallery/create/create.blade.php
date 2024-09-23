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

        .image-preview {
            display: flex;
            align-items: center;
        }

        .image-preview img {
            max-width: 700px;
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
            <h3 class="card-comment">Create Gallery</h3>
        </div>
        <a href="{{ route('admin.galleries.index') }}" class="btn btn-info card">Back</a>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ route('admin.galleries.store') }}" method="post" enctype="multipart/form-data" id="dynamicForm">
                @csrf
                <div class="row">

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
