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
                        {{ __('form.direction.add_direction') }}
                    </h4>
                </div>
                <div class="card-body collapse show" id="collapse8">
                    <form class="needs-validation" action="{{ route("directions.store") }}" method="post"
                          enctype="multipart/form-data">
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
                                    </div>
                                    <div class="mb-3">
                                        <label for="summernote">{{ __('table.requirement', locale: 'uz') }}</label>
                                        <textarea id="summernote" name="requirement[uz]"></textarea>
                                        @if($errors->has("requirement.uz"))
                                            <div class="text-danger">{{ $errors->first("requirement.uz") }}</div>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="contract_currency[uz]">{{ __('form.direction.contract_currency', locale: 'uz') }}($)</label>
                                        <input type="text" class="form-control file-value" id="contract_currency[uz]" name="contract_currency[uz]">
                                        @if($errors->has('contract_currency.uz'))
                                            <div class="text-danger">{{ $errors->first('contract_currency.uz') }}</div>
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
                                    </div>
                                    <div class="mb-3">
                                        <label for="summernote2">{{ __('table.requirement', locale: 'ru') }}</label>
                                        <div class="">
                                            <textarea id="summernote3" name="requirement[ru]"></textarea>
                                        </div>
                                        @if($errors->has("requirement.ru"))
                                            <div class="text-danger">{{ $errors->first("requirement.ru") }}</div>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="contract_currency[ru]">{{ __('form.direction.contract_currency', locale: 'ru') }}($)</label>
                                        <input type="text" class="form-control file-value" id="contract_currency[ru]" name="contract_currency[ru]">
                                        @if($errors->has('contract_currency.ru'))
                                            <div class="text-danger">{{ $errors->first('contract_currency.ru') }}</div>
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
                                    </div>
                                    <div class="mb-3">
                                        <label for="summernote2">{{ __('table.requirement', locale: 'en') }}</label>
                                        <div class="">
                                            <textarea id="summernote2" name="requirement[en]"></textarea>
                                        </div>
                                        @if($errors->has("requirement.en"))
                                            <div class="text-danger">{{ $errors->first("requirement.en") }}</div>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="contract_currency[en]">{{ __('form.direction.contract_currency', locale: 'en') }}($)</label>
                                        <input type="text" class="form-control file-value" id="contract_currency[en]" name="contract_currency[en]">
                                        @if($errors->has('contract_currency.en'))
                                            <div class="text-danger">{{ $errors->first('contract_currency.en') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="contract_amount">{{ __('form.direction.contract_amount') }}</label>
                                <input type="text" class="form-control file-value" id="contract_amount" name="contract_amount">
                                @if($errors->has('contract_amount'))
                                    <div class="text-danger">{{ $errors->first('contract_amount') }}</div>
                                @endif
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="university_id">{{ __('form.university.university') }}</label>
                                <select class="form-control select2 select2-hidden-accessible" tabindex="-1"
                                        aria-hidden="true" id="university_id" name="university_id">
                                    <option value="" selected disabled>{{ __('form.university.university') }} {{ __('table.choose') }}</option>
                                    @foreach($universities as $university)
                                        <option
                                            value="{{ $university->id }}">{{ $university->nameTr ?? $university->name_uz }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('university_id'))
                                    <div class="text-danger">{{ $errors->first('university_id') }}</div>
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
            // placeholder: 'Information direction',
            tabsize: 2,
            height: 150
        });
        $('#summernote2').summernote({
            // placeholder: 'Information direction',
            tabsize: 2,
            height: 150
        });
        $('#summernote3').summernote({
            // placeholder: 'Information direction',
            tabsize: 2,
            height: 150
        });
    </script>
@endsection

