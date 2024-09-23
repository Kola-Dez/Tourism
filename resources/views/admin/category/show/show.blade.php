@php use Carbon\Carbon; @endphp
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

        .container {
            max-width: 700px;
            margin: 30px;
            padding: 30px;
        }

        .slider-img {
            max-width: 700px;
            max-height: 500px;
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

        .slider {
            width: 700px;
            height: 500px;
            border: 2px solid black;
            border-radius: 10%;
            overflow: hidden;
            position: relative;
        }

        .slider-line {
            height: 500px;
            display: flex;
            position: absolute;
            left: 0;
            transition: all ease 2s;
        }

    </style>
    <div class="card card-green">
        <div class="card-header">
            <h3 class="card-comment">Category: {{ $category['title'] }}</h3>
        </div>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-info card">Back</a>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <!-- Заголовок -->
                    <div class="form-group">
                        <label>Title: {{ $category['title'] }}</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-5">
                    <!-- Изображение -->
                    <label>Image</label>
                    <div class="image-preview">
                        <img src="{{ $category['image'] }}" alt="Image Preview"
                             class="img-fluid @if(!$category['image']) d-none @endif">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
