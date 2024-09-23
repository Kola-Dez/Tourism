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
            <h3 class="card-comment">Travel Destination: {{ $travelDestination['name'] }}</h3>
        </div>
        <a href="{{ route('admin.travel_destinations.index') }}" class="btn btn-info card">Back</a>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <!-- Заголовок -->
                    <div class="form-group">
                        <label>Title: {{ $travelDestination['name'] }}</label>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Title: {{ $travelDestination['destination'] }}</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <!-- Описание -->
                    <div class="form-group">
                        <label>Description</label>
                        <p>{{ $travelDestination['description'] }}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-5">
                    <!-- Изображение -->
                    <label>Image</label>
                    <div class="image-preview">
                        <img src="{{ $travelDestination['image'] }}" alt="Image Preview"
                             class="img-fluid @if(!$travelDestination['image']) d-none @endif">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
