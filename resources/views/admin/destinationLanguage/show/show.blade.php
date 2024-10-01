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
            <h3 class="card-comment">Destination language: {{ $destinationTranslation['name'] }}</h3>
        </div>
        <a href="{{ route('admin.destination_languages.index') }}" class="btn btn-info card">Back</a>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Code: {{ $destinationTranslation['code'] }}</label>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Language: {{ $destinationTranslation['language'] }}</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Name: {{ $destinationTranslation['name'] }}</label>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Translate name: {{ $destinationTranslation['translate_name'] }}</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <!-- Описание -->
                    <div class="form-group">
                        <label>Description</label>
                        <p>{{ $destinationTranslation['description'] }}</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <!-- Описание -->
                    <div class="form-group">
                        <label>Translate description</label>
                        <p>{{ $destinationTranslation['translate_description'] }}</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
