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
    <div class="card card-warning">
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
                            <input type="number" class="form-control" name="peoples" placeholder="Enter ...">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <!-- Date input for departing -->
                        <div class="form-group">
                            <label>Departing</label>
                            <input type="date" class="form-control" name="departing" placeholder="Enter departing date">
                        </div>
                        <!-- Date input for finishing -->
                        <div class="form-group">
                            <label>Finishing</label>
                            <input type="date" class="form-control" name="finishing" placeholder="Enter finishing date">
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
                    </div>
                </div>

                <!-- input states -->
                <div class="form-group">
                    <label class="col-form-label" for="inputSuccess"><i class="fas fa-check"></i>  Inclusions</label>
                    <input type="text" class="form-control is-valid" id="inputSuccess" placeholder="Enter ...">
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="inputWarning"><i class="far fa-bell"></i>  Exclusions</label>
                    <input type="text" class="form-control is-warning" id="inputWarning" placeholder="Enter ...">
                </div>
                <div class="row">
                    <div class="col-sm-6">
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

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Выберите страну</label>
                            <select class="form-control" id="country-select" name="destination">
                                <option value="">Выберите страну</option>
                                @foreach($destinations as $destination)
                                    <option value="{{ $destination['slug'] }}">{{ $destination['name'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group" id="city-group" style="display: none;">
                            <label>Выберите город</label>
                            <select class="form-control" id="city-select" name="travel">
                                <option value="">Выберите город</option>
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
                            const filteredData = source.filter(item => item.destination_slug === selectedCountry);

                            filteredData.forEach(city => {

                                const option = document.createElement('option');

                                option.value = city.slug;
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

@endsection
