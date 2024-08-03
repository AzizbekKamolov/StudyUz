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
                        {{ __('form.university.add_university') }}
                    </h4>
                </div>
                <div class="card-body collapse show" id="collapse8">
                    <form class="needs-validation" action="{{ route("universities.store") }}" method="post" enctype="multipart/form-data">
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
                                        <label for="name['uz']">Name uz</label>
                                        <input type="text" class="form-control" id="name['uz']" name="name['uz']"
                                               value="{{ old("name['uz']") }}">
                                        @if($errors->has("name['uz']"))
                                            <div class="text-danger">{{ $errors->first("name['uz']") }}</div>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="summernote">Description uz</label>
                                        <textarea id="summernote" name="description['uz']"></textarea>
                                        @if($errors->has("description['uz']"))
                                            <div class="text-danger">{{ $errors->first("description['uz']") }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="tab-pane fade mb-3 mt-3" id="navs-top-ru">
                                    <div class="mb-3">
                                        <label for="name['ru']">Name Ru</label>
                                        <input type="text" class="form-control" id="last_name" name="name['ru']"
                                               value="{{ old("name['ru']") }}">
                                        @if($errors->has("name['ru']"))
                                            <div class="text-danger">{{ $errors->first("name['ru']") }}</div>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="summernote2">Description ru</label>
                                        <div class="">
                                            <textarea id="summernote3" name="description['ru']"></textarea>
                                        </div>
                                        @if($errors->has("description['ru']"))
                                            <div class="text-danger">{{ $errors->first("description['ru']") }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="tab-pane fade mb-3 mt-3" id="navs-top-en">
                                    <div class="mb-3">
                                        <label for="name['en']">Name en</label>
                                        <input type="text" class="form-control" id="name['en']" name="name['en']"
                                               value="{{ old("name['en']") }}">
                                        @if($errors->has("name['en']"))
                                            <div class="text-danger">{{ $errors->first("name['en']") }}</div>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="summernote2">Description ru</label>
                                        <div class="">
                                            <textarea id="summernote2" name="description['en']"></textarea>
                                        </div>
                                        @if($errors->has("description['en']"))
                                            <div class="text-danger">{{ $errors->first("description['en']") }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="logo">Logo</label>
                                <input type="file" class="form-control file-value" id="logo" name="logo">
                                @if($errors->has('logo'))
                                    <div class="text-danger">{{ $errors->first('logo') }}</div>
                                @endif
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="country_id">Country</label>
                                <input type="text" class="form-control" id="country_id" name="country_id"
                                       value="{{ old('country_id') }}">
                                @if($errors->has('country_id'))
                                    <div class="text-danger">{{ $errors->first('country_id') }}</div>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="city_id">City</label>
                                <input type="text" class="form-control" id="city_id" name="city_id"
                                       value="{{ old('phone') }}">
                                @if($errors->has('phone'))
                                    <div class="text-danger">{{ $errors->first('phone') }}</div>
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

        // summernote.summernote()
        // $(document).ready(function(){
        //     $('#summernote').summernote();
        //     $('#summernote2').summernote();
        //     $('#summernote3').summernote();
        // });
    </script>
@endsection

