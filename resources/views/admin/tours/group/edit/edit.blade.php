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
    <div class="card card-green">
        <div class="card-header">
            <h3 class="card-comment">Edit Group Tour</h3>
        </div>
        <a href="{{ route('admin.group_tours.index') }}" class="btn btn-info card">Back</a>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ route('admin.group_tours.update', $data['groupTour']['id']) }}" method="post" enctype="multipart/form-data" id="dynamicForm">
                @method('Patch')
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <!-- Title input -->
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Enter ..." value="{{ $data['groupTour']['title'] }}">
                            @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Price input -->
                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" placeholder="Enter ..." value="{{ $data['groupTour']['price'] }}">
                            @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Peoples input -->
                        <div class="form-group">
                            <label>Peoples</label>
                            <input type="number" class="form-control @error('how_many_peoples') is-invalid @enderror" name="how_many_peoples" placeholder="Enter ..." value="{{ $data['groupTour']['peoples'] }}">
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
                            <input type="date" class="form-control @error('departing') is-invalid @enderror" name="departing" placeholder="Enter departing date" value="{{ $data['groupTour']['departing'] }}">
                            @error('departing')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Finishing input -->
                        <div class="form-group">
                            <label>Finishing</label>
                            <input type="date" class="form-control @error('finishing') is-invalid @enderror" name="finishing" placeholder="Enter finishing date" value="{{ $data['groupTour']['finishing'] }}">
                            @error('finishing')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

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
                                    <img src="{{ $data['groupTour']['image'] }}" alt="Image Preview" class="img-fluid @if(!$data['groupTour']['image']) d-none @endif" id="previewImage">
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
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="3" placeholder="Enter ...">{{ $data['groupTour']['description'] }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Inclusions textarea -->
                        <div class="form-group">
                            <label class="col-form-label" for="inputSuccess"><i class="fas fa-check"></i> Inclusions</label>
                            <textarea class="form-control @error('inclusions') is-invalid @enderror" name="inclusions" rows="3" id="inputSuccess" placeholder="Enter ...">{{ $data['groupTour']['inclusions'] }}</textarea>
                            @error('inclusions')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Exclusions textarea -->
                        <div class="form-group">
                            <label class="col-form-label" for="inputWarning"><i class="far fa-bell"></i> Exclusions</label>
                            <textarea class="form-control @error('exclusions') is-invalid @enderror" name="exclusions" rows="3" id="inputWarning" placeholder="Enter ...">{{ $data['groupTour']['exclusions'] }}</textarea>
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
                                <input class="form-check-input" type="radio" name="status" value="available" {{ $data['groupTour']['status'] == 'available' ? 'checked' : '' }}>
                                <label class="form-check-label">available</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="unavailable" {{ $data['groupTour']['status'] == 'unavailable' ? 'checked' : '' }}>
                                <label class="form-check-label">unavailable</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="pending" {{ $data['groupTour']['status'] == 'pending' ? 'checked' : '' }}>
                                <label class="form-check-label">pending</label>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-4" id="content">
                        <div class="form-group">
                            <label>Destination</label>
                            <input type="text" class="form-control @error('destination') is-invalid @enderror"
                                   placeholder="Enter ..."
                                   value="{{ $data['groupTour']['destination'] }}"
                                   readonly>
                            @error('destination')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Travel destination</label>
                            <input type="text" class="form-control @error('travel_destination') is-invalid @enderror"
                                   id="display-text"
                                   placeholder="Enter ..."
                                   value="{{ $data['groupTour']['travel_destination'] }}"
                                   readonly>
                            <input type="hidden" name="travel_destination_id"
                                   id="hidden-input"
                                   value="{{ explode('-', $data['groupTour']['travel_destination_slug'])[0] }}">
                            @error('destination')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <button type="button" class="btn btn-warning" id="showButton">Edit</button>

                    <div class="col-sm-4">
                        <!-- Category select -->
                        <div class="form-group">
                            <label>Выберите тип</label>
                            <select class="form-control @error('category_id') is-invalid @enderror" id="category-select" name="category_id">
                                <option value="{{ explode('-', $data['groupTour']['category_slug'])[0] }}" @if(!$data['groupTour']['category']) selected @endif>{{ $data['groupTour']['category'] }}</option>
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
                    <div class="col-sm-5" style="margin-bottom: 1%">
                        <div class="form-group" id="fieldsContainer">
                            @foreach($data['itineraries'] as $itinerary)
                                <div class="fieldGroup" data-field-id="{{$itinerary['day_number']}}">
                                    <label for="day{{$itinerary['day_number']}}" style="margin-right: 5%;">Day {{ $itinerary['day_number'] }}:</label>
                                    <label>Title
                                        <input type="text" class="form-control" name="days[day{{ $itinerary['day_number'] }}][title]" id="title{{$itinerary['day_number']}}" placeholder="Enter title" value="{{ $itinerary['title'] }}">
                                    </label>
                                    <label>Description
                                        <input type="text" class="form-control" name="days[day{{ $itinerary['day_number'] }}][description]" id="description{{$itinerary['day_number']}}" placeholder="Enter description" value="{{ $itinerary['description'] }}">
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-info" id="addField">Add More</button>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>

    <!-- JavaScript code -->

    <script>
        document.getElementById('showButton').addEventListener('click', function () {
            const contentDiv = document.getElementById('content');

            contentDiv.innerHTML = `
        <div class="form-group">
            <label>Выберите страну</label>
            <select class="form-control" id="country-select" name="travel_destination_id">
                <option value="">Select country</option>
                @foreach($data['destinations'] as $destination)
            <option value="{{ $destination['id'] }}" {{ old('travel_destination_id') == $destination['id'] ? 'selected' : '' }}>{{ $destination['name'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group" id="city-group" style="display: none;">
            <label>Select city</label>
            <select class="form-control" id="city-select" name="travel_destination_id">
                <option value="">Выберите город</option>
            </select>
        </div>
    `;

            // Теперь добавляем обработчик после обновления содержимого
            const countrySelect = document.getElementById('country-select');
            const cityGroup = document.getElementById('city-group');
            const citySelect = document.getElementById('city-select');

            countrySelect.addEventListener('change', function () {
                const selectedCountry = this.value;

                if (selectedCountry) {
                    citySelect.innerHTML = '';
                    cityGroup.style.display = 'block';
                    const url = '/api/v1/travels';

                    fetch(url, {
                        method: 'GET',
                        headers: {
                            'Accept-Language': 'en',
                        }
                    })
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

        document.addEventListener('DOMContentLoaded', () => {
            let fieldCount = 3;
            const maxFields = 30;
            const fieldsContainer = document.getElementById('fieldsContainer');
            const addFieldButton = document.getElementById('addField');

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
                        <label for="day${fieldCount}" style="margin-right: 5%;">Day ${fieldCount}:</label>
                        <label>Title
                            <input type="text" class="form-control" name="days[day${fieldCount}][title]" id="title${fieldCount}" placeholder="Enter title">
                        </label>
                        <label>Description
                            <input type="text" class="form-control" name="days[day${fieldCount}][description]" id="description${fieldCount}" placeholder="Enter description">
                        </label>
                        <button type="button" class="removeField btn btn-danger">Remove</button>
                    `;

                    newFieldGroup.querySelector('.removeField').addEventListener('click', () => {
                        removeField(newFieldGroup);
                    });

                    fieldsContainer.appendChild(newFieldGroup);

                    newFieldGroup.scrollIntoView({ behavior: 'smooth', block: 'start' });
                } else {
                    alert('You have reached the maximum number of fields.');
                }
            });

            fieldsContainer.addEventListener('click', (event) => {
                if (event.target.classList.contains('removeField')) {
                    const fieldGroup = event.target.closest('.fieldGroup');
                    removeField(fieldGroup);
                }
            });
        });
    </script>
@endsection
