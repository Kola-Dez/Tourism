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
            <h3 class="card-comment">Create Group Tour</h3>
        </div>
        <a href="{{ route('admin.group_tours.index') }}" class="btn btn-info card">Back</a>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ route('admin.group_tours.store') }}" method="post" enctype="multipart/form-data" id="dynamicForm">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <!-- Title input -->
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Enter ..." value="{{ old('title') }}">
                            @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Price input -->
                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" placeholder="Enter ..." value="{{ old('price') }}">
                            @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Peoples input -->
                        <div class="form-group">
                            <label>Peoples</label>
                            <input type="number" class="form-control @error('how_many_peoples') is-invalid @enderror" name="how_many_peoples" placeholder="Enter ..." value="{{ old('how_many_peoples') }}">
                            @error('how_many_peoples')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <!-- Departing input -->
                        <div class="form-group">
                            <label>Departing</label>
                            <input type="date" class="form-control @error('departing') is-invalid @enderror" name="departing" placeholder="Enter departing date" value="{{ old('departing') }}">
                            @error('departing')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Finishing input -->
                        <div class="form-group">
                            <label>Finishing</label>
                            <input type="date" class="form-control @error('finishing') is-invalid @enderror" name="finishing" placeholder="Enter finishing date" value="{{ old('finishing') }}">
                            @error('finishing')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

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
                    <!-- Upload Multiple Images -->
                    <div class="form-group">
                        <label class="form-label @error('images') is-invalid @enderror">Upload Images</label>
                        @error('images')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        <div class="d-flex align-items-center">
                            <input type="file" id="imagesUpload" name="images[]" multiple class="d-none">
                            <button type="button" class="btn btn-primary" id="uploadImagesButton">
                                <i class="fas fa-upload"></i> Choose Images
                            </button>
                        </div>
                    </div>

                    <!-- Slider -->
                    <div class="container">
                        <div class="slider">
                            <div class="slider-line" id="sliderLine">
                                <!-- Изображения будут добавляться сюда -->
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary slider-prev">Prev</button>
                        <button type="button" class="btn btn-primary slider-next">Next</button>
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

                        <!-- Inclusions textarea -->
                        <div class="form-group">
                            <label class="col-form-label" for="inputSuccess"><i class="fas fa-check"></i> Inclusions</label>
                            <textarea class="form-control @error('inclusions') is-invalid @enderror" name="inclusions" rows="3" id="inputSuccess" placeholder="Enter ...">{{ old('inclusions') }}</textarea>
                            @error('inclusions')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Exclusions textarea -->
                        <div class="form-group">
                            <label class="col-form-label" for="inputWarning"><i class="far fa-bell"></i> Exclusions</label>
                            <textarea class="form-control @error('exclusions') is-invalid @enderror" name="exclusions" rows="3" id="inputWarning" placeholder="Enter ...">{{ old('exclusions') }}</textarea>
                            @error('exclusions')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <!-- Status radio buttons -->
                        <h4>Status</h4>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="available" checked {{ old('status') == 'available' ? 'checked' : '' }}>
                                <label class="form-check-label">available</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="unavailable" {{ old('status') == 'unavailable' ? 'checked' : '' }}>
                                <label class="form-check-label">unavailable</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="pending" {{ old('status') == 'pending' ? 'checked' : '' }}>
                                <label class="form-check-label">pending</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <!-- Country select -->
                        <div class="form-group">
                            <label>Select country</label>
                            <select class="form-control @error('travel_destination_id') is-invalid @enderror" id="country-select" name="travel_destination_id">
                                <option value="">Select country</option>
                                @foreach($data['destinations'] as $destination)
                                    <option value="{{ $destination['id'] }}" >{{ $destination['name'] }}</option>
                                @endforeach
                            </select>
                            @error('travel_destination_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- City select -->
                        <div class="form-group" id="city-group" style="display: none;">
                            <label>Select city</label>
                            <select class="form-control @error('travel_destination_id') is-invalid @enderror" id="city-select" name="travel_destination_id">
                                <option value="">Выберите город</option>
                            </select>
                            @error('travel_destination_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <!-- Category select -->
                        <div class="form-group">
                            <label>Select type</label>
                            <select class="form-control @error('category_id') is-invalid @enderror" id="category-select" name="category_id">
                                <option value="">Select type</option>
                                @foreach($data['categories'] as $category)
                                    <option value="{{ $category['id'] }}" {{ old('category_id') == $category['id'] ? 'selected' : '' }}>{{ $category['title'] }}</option>
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
                    <div class="col-sm-12">
                        <div class="form-group" id="fieldsContainer">
                                <div class="fieldGroup card p-3 my-3" data-field-id="1">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <label for="day1" class="h5">Day 1:</label>
                                        <button type="button" class="btn btn-danger removeField">Remove</button>
                                    </div>

                                    <label class="mt-2">Title</label>
                                    @error('days.day1.title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    <input type="text" class="form-control @error('days.day1.title') is-invalid @enderror mb-3" name="days[day1][title]" id="title1" placeholder="Enter title" value="{{ old('days.day1.title') }}">

                                    <label>Description</label>
                                    @error('days.day1.description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    <textarea type="text" class="form-control @error('days.day1.description') @enderror mb-3" rows="10" name="days[day1][description]" id="description1" placeholder="Enter description">{{ old('days.day1.description') }}</textarea>
                                </div>
                        </div>

                        <button type="button" class="btn btn-info w-100" id="addField">Add More</button>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sliderLine = document.getElementById('sliderLine');
            const imageWidth = 700;
            let offset = 0;

            // Функция для обновления размеров слайдера
            function updateSlider() {
                sliderLine.style.width = 0;
                Array.from(sliderLine.children).forEach(img => {
                    img.style.width = '1000px';
                });
            }

            // Функция для переключения на следующее изображение
            function moveToNext() {
                const totalWidth = sliderLine.scrollWidth;
                offset += imageWidth;
                if (offset >= totalWidth) {
                    offset = 0;
                }
                sliderLine.style.transition = 'left 0.5s ease';
                sliderLine.style.left = -offset + 'px';
            }

            // Функция для переключения на предыдущее изображение
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

            // Обработчик для загрузки нескольких изображений
            document.getElementById('uploadImagesButton').addEventListener('click', function() {
                document.getElementById('imagesUpload').click();
            });

            document.getElementById('imagesUpload').addEventListener('change', function(event) {
                const files = event.target.files;

                // Очистка текущих изображений из слайдера
                while (sliderLine.firstChild) {
                    sliderLine.removeChild(sliderLine.firstChild);
                }

                // Добавление новых изображений в слайдер
                Array.from(files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.alt = 'Image';
                        sliderLine.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                });

                // Обновление слайдера после загрузки изображений
                updateSlider();
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const countrySelect = document.getElementById('country-select');
            const cityGroup = document.getElementById('city-group');
            const citySelect = document.getElementById('city-select');

            // Обработчик изменения страны
            countrySelect.addEventListener('change', function () {
                const selectedCountry = this.value;

                if (selectedCountry) {
                    citySelect.innerHTML = '';
                    cityGroup.style.display = 'block';
                    const url = '/api/v1/travels';

                    fetch(url)
                        .then(response => response.json())
                        .then(data => {
                            const source = data.data;
                            const filteredData = source.filter(item => {
                                const slugParts = item.destination_slug.split('-');
                                const numberPart = slugParts[0];
                                return numberPart === selectedCountry;
                            });

                            filteredData.forEach(city => {
                                const option = document.createElement('option');
                                const slugParts = city.slug.split('-');
                                option.value = slugParts[0];
                                option.textContent = city.name;

                                citySelect.appendChild(option);
                            });
                        })
                        .catch(error => {
                            console.error('Error: ', error);
                        });
                } else {
                    cityGroup.style.display = 'none';
                    citySelect.innerHTML = '';
                }
            });
        });

        document.addEventListener('DOMContentLoaded', () => {
            let fieldCount = 1;
            const maxFields = 30;
            const fieldsContainer = document.getElementById('fieldsContainer');
            const addFieldButton = document.getElementById('addField');

            // Функция для удаления полей
            function removeField(fieldGroup) {
                if (fieldCount > 1 && Number(fieldGroup.getAttribute('data-field-id')) === fieldCount) {
                    fieldGroup.remove();
                    fieldCount--;

                    const lastFieldGroup = fieldsContainer.querySelector(`.fieldGroup[data-field-id="${fieldCount}"]`);
                    const removeButton = lastFieldGroup.querySelector('.removeField');
                    if (removeButton) {
                        removeButton.style.display = 'inline-block';
                    }
                }
            }

            // Обработчик добавления нового поля
            addFieldButton.addEventListener('click', () => {
                if (fieldCount < maxFields) {
                    const lastFieldGroup = fieldsContainer.querySelector(`.fieldGroup[data-field-id="${fieldCount}"]`);
                    const removeButton = lastFieldGroup.querySelector('.removeField');
                    if (removeButton) {
                        removeButton.style.display = 'none';
                    }

                    fieldCount++;
                    const newFieldGroup = document.createElement('div');
                    newFieldGroup.className = 'fieldGroup';
                    newFieldGroup.setAttribute('data-field-id', fieldCount);

                    newFieldGroup.innerHTML = `
                        <div class="fieldGroup card p-3 my-3" data-field-id="${fieldCount}">
                            <div class="d-flex justify-content-between align-items-center">
                                <label for="day${fieldCount}" class="h5">Day ${fieldCount}:</label>
                                <button type="button" class="removeField btn btn-danger">Remove</button>
                            </div>

                            <div class="form-group mt-3">
                                <label for="title${fieldCount}">Title</label>
                                <input type="text" class="form-control mb-3" name="days[day${fieldCount}][title]" id="title${fieldCount}" placeholder="Enter title">
                            </div>

                            <div class="form-group">
                                <label for="description${fieldCount}">Description</label>
                                <textarea class="form-control mb-3" rows="10" name="days[day${fieldCount}][description]" id="description${fieldCount}" placeholder="Enter description"></textarea>
                            </div>
                        </div>
                    `;

                    // Добавляем обработчик удаления для нового поля
                    newFieldGroup.querySelector('.removeField').addEventListener('click', () => {
                        removeField(newFieldGroup);
                    });

                    fieldsContainer.appendChild(newFieldGroup);

                    // Прокрутка к новому полю
                    newFieldGroup.scrollIntoView({ behavior: 'smooth', block: 'start' });
                } else {
                    alert('You have reached the maximum number of fields.');
                }
            });

            // Обработчик кликов по кнопке удаления поля
            fieldsContainer.addEventListener('click', (event) => {
                if (event.target.classList.contains('removeField')) {
                    const fieldGroup = event.target.closest('.fieldGroup');
                    removeField(fieldGroup);
                }
            });
        });
    </script>

@endsection
