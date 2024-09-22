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
            <h3 class="card-comment">Private tour: {{ $privateTour['title'] }}</h3>
        </div>
        <a href="{{ route('admin.private_tours.index') }}" class="btn btn-info card">Back</a>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <!-- Заголовок -->
                    <div class="form-group">
                        <label>Title: {{ $privateTour['title'] }}</label>
                    </div>

                </div>

                <div class="col-sm-6">
                    <!-- Даты -->
                    <div class="form-group">
                        <label>Departing: {{ Carbon::parse($privateTour['departing'])->format('Y-m-d') }}</label>
                    </div>

                    <div class="form-group">
                        <label>Finishing: {{ Carbon::parse($privateTour['finishing'])->format('Y-m-d') }}</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <!-- Описание -->
                    <div class="form-group">
                        <label>Description</label>
                        <p>{{ $privateTour['description'] }}</p>
                    </div>

                    <!-- Включения -->
                    <div class="form-group">
                        <label>Inclusions</label>
                        <p>{{ $privateTour['inclusions'] }}</p>
                    </div>

                    <!-- Исключения -->
                    <div class="form-group">
                        <label>Exclusions</label>
                        <p>{{ $privateTour['exclusions'] }}</p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <h3 class="text-center">Itineraries</h3>
                    <div class="timeline">
                        @foreach($privateTour['itineraries'] as $day)
                            <div class="timeline-item card mb-4 p-3 shadow-sm">
                                <h5 class="day-number text-primary">Day {{ $day['day_number'] }}</h5>
                                <h6 class="title font-weight-bold">{{ $day['title'] }}</h6>
                                <p class="description text-muted">{{ $day['description'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-sm-5">
                    <!-- Изображение -->
                    <label>Image</label>
                    <div class="image-preview">
                        <img src="{{ $privateTour['image'] }}" alt="Image Preview"
                             class="img-fluid @if(!$privateTour['image']) d-none @endif">
                    </div>
                </div>
                @if($privateTour['images'])
                    <div class="col-sm-5">
                        <label>Images</label>
                        <div class="container">
                            <div class="slider">
                                <div class="slider-line" id="sliderLine">
                                    @foreach ($privateTour['images'] as $image)
                                        <img src="{{ $image }}" alt="Image Preview" class="slider-img" onerror="this.style.display='none';">
                                    @endforeach
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary slider-prev">Prev</button>
                            <button type="button" class="btn btn-primary slider-next">Next</button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sliderLine = document.getElementById('sliderLine');
            const imageWidth = 700;
            let offset = 0;

            function updateSlider() {
                sliderLine.style.width = 0;
                Array.from(sliderLine.children).forEach(img => {
                    img.style.width = '700px';
                });
            }

            function moveToNext() {
                const totalWidth = sliderLine.scrollWidth;
                offset += imageWidth;
                if (offset >= totalWidth) {
                    offset = 0;
                }
                sliderLine.style.transition = 'left 0.5s ease';
                sliderLine.style.left = -offset + 'px';
            }

            function moveToPrev() {
                offset -= imageWidth;
                if (offset < 0) {
                    offset = sliderLine.scrollWidth - imageWidth;
                }
                sliderLine.style.transition = 'left 0.5s ease';
                sliderLine.style.left = -offset + 'px';
            }

            document.querySelector('.slider-next').addEventListener('click', moveToNext);
            document.querySelector('.slider-prev').addEventListener('click', moveToPrev);

            // Обновляем слайдер после загрузки страницы
            updateSlider();
        });
    </script>
@endsection
