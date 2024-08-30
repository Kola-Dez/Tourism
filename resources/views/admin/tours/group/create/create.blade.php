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

        .image-preview img {
            max-width: 200px;
            height: auto;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-left: 10px;
        }

        .d-none {
            display: none;
        }
    </style>
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Create Group Tour</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ route('admin.group_tours.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Enter ...">
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" class="form-control" name="price" placeholder="Enter ...">
                        </div>
                        <div class="form-group">
                            <label>Peoples</label>
                            <input type="number" class="form-control" name="how_many_peoples" placeholder="Enter ...">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Departing</label>
                            <input type="date" class="form-control" name="departing" placeholder="Enter departing date">
                        </div>
                        <div class="form-group">
                            <label>Finishing</label>
                            <input type="date" class="form-control" name="finishing" placeholder="Enter finishing date">
                        </div>



                        <!-- New file input field -->
                        <div class="form-group">
                            <label class="form-label">Upload Image</label>
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
                        <!-- textarea -->
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="description" rows="3" placeholder="Enter ..."></textarea>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="inputSuccess"><i class="fas fa-check"></i>  Inclusions</label>
                            <textarea class="form-control is-valid" name="inclusions" rows="3" id="inputSuccess" placeholder="Enter ..."></textarea>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="inputWarning"><i class="far fa-bell"></i>  Exclusions</label>
                            <textarea class="form-control is-warning" name="exclusions" rows="3" id="inputWarning" placeholder="Enter ..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <!-- radio -->
                        <h4>Status</h4>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="available" checked="">
                                <label class="form-check-label">available</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="unavailable">
                                <label class="form-check-label">unavailable</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="pending">
                                <label class="form-check-label">pending</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Выберите страну</label>
                            <select class="form-control" id="country-select">
                                <option value="">Выберите страну</option>
                                @foreach($data['destinations'] as $destination)
                                    <option value="{{ $destination['id'] }}">{{ $destination['name'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group" id="city-group" style="display: none;">
                            <label>Выберите город</label>
                            <select class="form-control" id="city-select" name="travel_destination_id">
                                <option value="">Выберите город</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Выберите тип</label>
                            <select class="form-control" id="country-select" name="category_id">
                                <option value="">Выберите тип</option>
                                @foreach($data['categories'] as $category)
                                    <option value="{{ $category['id'] }}">{{ $category['title'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const countrySelect = document.getElementById('country-select');
            const cityGroup = document.getElementById('city-group');
            const citySelect = document.getElementById('city-select');

            countrySelect.addEventListener('change', function () {
                const selectedCountry = this.value;

                if (selectedCountry) {

                    citySelect.innerHTML = '';
                    cityGroup.style = 'display: block';
                    const url = '/api/v1/travel';

                    fetch(url)
                        .then(response => response.json())
                        .then(data => {
                            const source = data.data;
                            console.log(data);
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
                            console.error('Ошибка при запросе:', error);
                        });

                } else {

                    cityGroup.style = 'display: none;';
                    citySelect.innerHTML = '';

                }
            });
        });
    </script>
    <script>
        document.getElementById('uploadButton').addEventListener('click', function() {
            document.getElementById('imageUpload').click();
        });

        document.getElementById('imageUpload').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const previewImage = document.getElementById('previewImage');

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.classList.remove('d-none');
                };

                reader.readAsDataURL(file);
            } else {
                previewImage.classList.add('d-none');
            }
        });
    </script>
@endsection
