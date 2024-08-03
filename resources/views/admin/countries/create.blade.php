@extends('admin.layouts.main')
@section('content')
    <div class="d-flex justify-content-center">
        <div class="col-md-10 col-lg-10">
            <div class="card mb-4 shadow-1">
                <div class="card-header">
                    <h4 class="card-header-title">
                        {{ __('form.country.add_country') }}
                    </h4>
                </div>
                <div class="card-body collapse show" id="collapse8">
                    <form class="needs-validation" action="{{ route("countries.store") }}" method="post">
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
                                               value="{{ old("name[uz]") }}">
                                        @if($errors->has("name.uz"))
                                            <div class="text-danger">{{ $errors->first("name.uz") }}</div>
                                        @endif
                                        @if($errors->has("name.ru"))
                                            <div class="text-danger">{{ $errors->first("name.ru") }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="tab-pane fade mb-3 mt-3" id="navs-top-ru">
                                    <div class="mb-3">
                                        <label for="name[ru]">{{ __('table.name', locale: 'ru') }}</label>
                                        <input type="text" class="form-control" id="name[ru]" name="name[ru]"
                                               value="{{ old("name[ru]") }}">
                                        @if($errors->has("name.ru"))
                                            <div class="text-danger">{{ $errors->first("name.ru") }}</div>
                                        @endif
                                        @if($errors->has("name.uz"))
                                            <div class="text-danger">{{ $errors->first("name[uz]") }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="tab-pane fade mb-3 mt-3" id="navs-top-en">
                                    <div class="mb-3">
                                        <label for="name[en]">{{ __('table.name', locale: 'en') }}</label>
                                        <input type="text" class="form-control" id="name[en]" name="name[en]"
                                               value="{{ old("name[en]") }}">
                                        @if($errors->has("name.en"))
                                            <div class="text-danger">{{ $errors->first("name.en") }}</div>
                                        @endif
                                        @if($errors->has("name.ru"))
                                            <div class="text-danger">{{ $errors->first("name.ru") }}</div>
                                        @endif
                                        @if($errors->has("name.uz"))
                                            <div class="text-danger">{{ $errors->first("name.uz") }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-success col-md-4" type="submit">{{ __('table.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

