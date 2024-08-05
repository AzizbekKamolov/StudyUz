@extends('admin.layouts.main')
@section('content')
    <div class="d-flex justify-content-center">
        <div class="col-md-6 col-lg-6">
            <div class="card mb-4 shadow-1">
                <div class="card-header">
                    <h4 class="card-header-title">
                        {{ __('form.attribute.edit_attribute') }}
                    </h4>
                </div>
                <div class="card-body collapse show" id="collapse8">
                    <form class="needs-validation" action="{{ route("attributes.update", [$item->id]) }}" method="post">
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
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="type">{{ __('form.attribute.type') }}</label>
                                <select class="form-control select2 select2-hidden-accessible" tabindex="-1"
                                        aria-hidden="true" id="type" name="type">
                                    <option value="1" @selected($item->type === 1)>{{ __('form.university.university') }}</option>
                                    <option value="2" @selected($item->type === 1)>{{ __('form.direction.direction') }}</option>
                                </select>
                                @if($errors->has('type'))
                                    <div class="text-danger">{{ $errors->first('type') }}</div>
                                @endif
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

        $(document).ready(function() {
            // Event handler for the button click
            $("#country_id").change(function(e) {
                $("#city_id").html('');
                // Make an AJAX request
                $.ajax({
                    url: '{{ route('cities.getCitiesByCountryId') }}?country_id=' + e.target.value, // Sample API endpoint
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // Update the content on success
                        console.log(data.data)
                        let items = `<option value="" selected
                                                disabled>{{ __('form.city.city') }} {{ __('table.choose') }}</option>`
                        data.data.forEach(function (item, value) {
                            items += `<option value="${item.id}">${item.nameTr ?? item.name_uz}</option>`
                        })
                        $("#city_id").html(items);
                    },
                    error: function(error) {
                        // Handle errors
                        console.error('Error:', error);
                    }
                });
            });
        });
    </script>
@endsection

