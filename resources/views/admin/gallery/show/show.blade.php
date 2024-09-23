@php use Carbon\Carbon; @endphp
@extends('admin.layouts.default')

@section('content')
    <style>
        .image-preview {
            display: flex;
            align-items: center;
        }

        label {
            font-size: 30px;
        }

        .image-preview .slider-img {
            max-width: 200px;
            height: auto;
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
            margin-bottom: 10px;
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
            <h3 class="card-comment">Gallery: {{ $gallery['id'] }}</h3>
        </div>
        <a href="{{ route('admin.galleries.index') }}" class="btn btn-info card">Back</a>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <!-- Изображение -->
                    <label>Image</label>
                    <div class="image-preview">
                        <img src="{{ $gallery['image'] }}" alt="Image Preview"
                             class="img-fluid @if(!$gallery['image']) d-none @endif">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
