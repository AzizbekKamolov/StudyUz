@extends('admin.layouts.main')
@section('head')
    <link href="{{ asset('assets/plugins/summernote/summernote-bs4.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="d-flex justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="card mb-4 shadow-1">
                <div class="card-header">
                    <h4 class="card-header-title">
                        {{ __('form.university.edit_university') }}
                    </h4>
                </div>
                <div class="card-body collapse show" id="collapse8">
                    <form class="needs-validation" action="{{ route("universities.update", [$item->id]) }}"
                          method="post"
                          enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="nav-tabs-top">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active show" data-toggle="tab" href="#navs-top-uz">
                                        <img src="{{ asset('assets/images/flags/Uzbekistan.png') }}" alt="uz"
                                             width="40">
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#navs-top-ru">
                                        <img src="{{ asset('assets/images/flags/russia.png') }}" alt="ru" width="40">
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#navs-top-en">
                                        <img src="{{ asset('assets/images/flags/usa.png') }}" alt="en" width="40">
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active show mt-3 mb-3" id="navs-top-uz">
                                    <div class="mb-3">
                                        <label for="name[uz]">{{ __('table.name', locale: 'uz') }}</label>
                                        <input type="text" class="form-control" id="name[uz]" name="name[uz]"
                                               value="{{ $item->name_uz }}">
                                        @if($errors->has("name.uz"))
                                            <div class="text-danger">{{ $errors->first("name.uz") }}</div>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="summernote">{{ __('table.description', locale: 'uz') }}</label>
                                        <textarea id="summernote"
                                                  name="description_uz">{{ $item->description_uz }}</textarea>
                                        @if($errors->has("description_uz"))
                                            <div class="text-danger">{{ $errors->first("description_uz") }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="tab-pane fade mb-3 mt-3" id="navs-top-ru">
                                    <div class="mb-3">
                                        <label for="name[ru]">{{ __('table.name', locale: 'ru') }}</label>
                                        <input type="text" class="form-control" id="name[ru]" name="name[ru]"
                                               value="{{ $item->name_ru }}">
                                        @if($errors->has("name.ru"))
                                            <div class="text-danger">{{ $errors->first("name.ru") }}</div>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="summernote3">{{ __('table.description', locale: 'ru') }}</label>
                                        <div class="">
                                            <textarea id="summernote3"
                                                      name="description_ru">{{ $item->description_ru }}</textarea>
                                        </div>
                                        @if($errors->has("description_ru"))
                                            <div class="text-danger">{{ $errors->first("description_ru") }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="tab-pane fade mb-3 mt-3" id="navs-top-en">
                                    <div class="mb-3">
                                        <label for="name[en]">{{ __('table.name', locale: 'en') }}</label>
                                        <input type="text" class="form-control" id="name[en]" name="name[en]"
                                               value="{{ $item->name_en }}">
                                        @if($errors->has("name.en"))
                                            <div class="text-danger">{{ $errors->first("name.en") }}</div>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="summernote2">{{ __('table.description', locale: 'en') }}</label>
                                        <div class="">
                                            <textarea id="summernote2"
                                                      name="description_en">{{ $item->description_en }}</textarea>
                                        </div>
                                        @if($errors->has("description_en"))
                                            <div class="text-danger">{{ $errors->first("description_en") }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-8 mb-3">
                                <label for="logo">{{ __('form.university.logo') }}</label>
                                <input type="file" class="form-control file-value" id="logo" name="logo">
                                @if($errors->has('logo'))
                                    <div class="text-danger">{{ $errors->first('logo') }}</div>
                                @endif
                            </div>
                            <div class="col-md-4 mb-3">
                                <div>
                                    <label for="logo">{{ __('form.university.logo') }}</label>
                                </div>
                                <img src="{{ asset("logos/$item->logo") }}" alt="Logo" width="150">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="country_id">{{ __('form.country.country') }}</label>
                                <select class="form-control select2 select2-hidden-accessible" tabindex="-1"
                                        aria-hidden="true" id="country_id" name="country_id">
                                    <option value="" selected
                                            disabled>{{ __('form.country.country') }} {{ __('table.choose') }}</option>
                                    @foreach($countries as $country)
                                        <option
                                            value="{{ $country->id }}"
                                            @selected($item->country_id === $country->id)
                                        >{{ $country->nameTr ?? $country->name_uz }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('country_id'))
                                    <div class="text-danger">{{ $errors->first('country_id') }}</div>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="city_id">{{ __('form.city.city') }}</label>
                                <select class="form-control select2 select2-hidden-accessible" tabindex="-1"
                                        aria-hidden="true" id="city_id" name="city_id">
                                    <option value="" selected
                                            disabled>{{ __('form.city.city') }} {{ __('table.choose') }}</option>
                                    @foreach($cities as $city)
                                        <option
                                            value="{{ $city->id }}"
                                            @selected($item->city_id === $city->id)
                                        >{{ $city->nameTr ?? $city->name_uz }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('city_id'))
                                    <div class="text-danger">{{ $errors->first('city_id') }}</div>
                                @endif
                            </div>
                            <div class="col-md-12" id="special_titles">
                                <label for="validationTooltip03">File</label><span
                                    class="btn btn-outline-success ml-3 mb-2" id="special_titles_button"><i
                                        class="fa fa-plus-circle"></i></span>

                                @foreach($item->university_attributes as $university_attribute)
                                    <div class="form-row ">
                                        <div class="col-md-3 mb-3">
                                            <input type="hidden" name="attributes[{{ $loop->iteration }}][id]" value="{{ $university_attribute->id }}">
                                            <select name="attributes[{{ $loop->iteration }}][attribute_id]" class="form-control">
                                                <option value="" selected
                                                        disabled>{{ __('form.attribute.attribute') }} {{ __('table.choose') }}</option>
                                                @foreach($attributes as $attribute)
                                                    <option value="{{ $attribute->id }}"
                                                    @selected($university_attribute->attribute_id == $attribute->id)
                                                    >{{ $attribute->nameTr }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-8 mb-3 ">
                                            <input type="text" class="form-control" id="validationTooltip03"
                                                   name="attributes[{{ $loop->iteration }}][value]" value="{{ $university_attribute->value }}">

                                        </div>
                                        <div class="col-md-1">
                                            <span class="btn btn-outline-danger special_titles_button_remove">-</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                        <div class="text-center mt-4">
                            <button class="btn btn-success col-md-4" type="submit">{{ __('table.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
section
@section('js')
    <script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $('#summernote').summernote({
            // placeholder: 'Information university',
            tabsize: 2,
            height: 150
        });
        $('#summernote2').summernote({
            // placeholder: 'Information university',
            tabsize: 2,
            height: 150
        });
        $('#summernote3').summernote({
            // placeholder: 'Information university',
            tabsize: 2,
            height: 150
        });

        $(document).ready(function () {
            // Event handler for the button click
            $("#country_id").change(function (e) {
                $("#city_id").html('');
                // Make an AJAX request
                $.ajax({
                    url: '{{ route('cities.getCitiesByCountryId') }}?country_id=' + e.target.value, // Sample API endpoint
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        // Update the content on success
                        console.log(data.data)
                        let items = `<option value="" selected
                                                disabled>{{ __('form.city.city') }} {{ __('table.choose') }}</option>`
                        data.data.forEach(function (item, value) {
                            items += `<option value="${item.id}">${item.nameTr ?? item.name_uz}</option>`
                        })
                        $("#city_id").html(items);
                    },
                    error: function (error) {
                        // Handle errors
                        console.error('Error:', error);
                    }
                });
            });
        });
        let counter = 100
        $('#special_titles_button').on('click', function (e) {
            e.preventDefault()
            counter++
            $('#special_titles').append(`<div class="form-row ">

                                    <div class="col-md-3 mb-3">
                                        <select name="attributes[${counter}][id]" class="form-control">
                                                <option value="" selected disabled>{{ __('form.attribute.attribute') }} {{ __('table.choose') }}</option>
                                            @foreach($attributes as $attribute)
            <option value="{{ $attribute->id }}">{{ $attribute->nameTr }}</option>
                                            @endforeach
            </select>
        </div>
        <div class="col-md-8 mb-3 ">
            <input type="text" class="form-control"
                    name="attributes[${counter}][value]">

        </div>
        <div class="col-md-1">
            <span class="btn btn-outline-danger special_titles_button_remove">-</span>
        </div>
     </div>
`)
        })
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('special_titles_button_remove')) {
                e.target.parentElement.parentElement.remove();
            }
        })
    </script>
@endsection

