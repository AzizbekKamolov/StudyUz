@extends('admin.layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12 mb-5">
            <div class="card mb-4 shadow-1">
                <div class="card-header">
                    <div class="card-header-title">
                        <h5><a href="{{ route('cities.index') }}">{{ __('form.city.cities') }}</a>
                        </h5>
                    </div>
                    {{--                    <div class="">--}}
                    @can('cities.store')
                        <a href="{{ route("cities.create") }}" class="btn btn-outline-success">
                            <i class="fa fa-plus button-2x"> {{ __('table.add') }}</i></a>
                    @endcan
                    {{--                    </div>--}}
                </div>
                <div class="card-body collapse show" id="collapse2">
                    <table class="table table-striped table-responsive-sm">
                        <thead>
                        <tr>
                            <form action="{{ route("cities.index") }}">
                                <th>
                                    <select class="form-control select2 select2-hidden-accessible" name="limit" style="width: 65px">
                                        <option value="5" @selected(request('limit') == 5)>5</option>
                                        <option value="10" @selected(request('limit') == 10 || is_null(request('limit')))>10</option>
                                        <option value="20" @selected(request('limit') == 20)>20</option>
                                        <option value="30" @selected(request('limit') == 30)>30</option>
                                    </select>
                                </th>
                                <th><input type="text" class="form-control" name="name"
                                           placeholder="{{ __('table.name') }}"
                                           value="{{ request('name') }}">
                                </th>
                                <th>
                                    <select class="form-control select2 select2-hidden-accessible" tabindex="-1"
                                            aria-hidden="true" id="country_id" name="country_id">
                                        <option value="" selected
                                                disabled>{{ __('form.country.country') }} {{ __('table.choose') }}</option>
                                        @foreach($countries as $country)
                                            <option
                                                value="{{ $country->id }}"
                                                @selected(request('country_id') == $country->id)
                                            >{{ $country->nameTr ?? $country->name_uz }}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th></th>
                                <th>
                                    <div class="col">
                                        <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                                        <a href="{{ route('cities.index') }}" class="btn btn-outline-info"><i
                                                class="fa fa-refresh"></i></a>
                                    </div>
                                </th>
                            </form>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>{{ __('table.name') }}</th>
                            <th>{{ __('form.country.country') }}</th>
                            <th>{{ __('table.created_at') }}</th>
                            <th>{{ __('table.actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pagination->items() as $item)
                            <tr>
                                <th scope="row">{{ ($pagination->currentpage()-1) * $pagination->perpage() + $loop->index + 1 }}</th>
                                <td>{{ $item->nameTr }}</td>
                                <td>{{ $item->countryName }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    @can('cities.update')
                                        <a href="{{ route("cities.edit", [$item->id]) }}">
                                            <i class="fa fa-edit text-purple button-2x"></i></a>
                                    @endcan
                                    {{--                                    <a href="">--}}
                                    {{--                                        <i class="fa fa-eye text-info button-2x"></i></a>--}}
                                    @can('cities.store')
                                        <a href="{{ route("cities.delete", [$item->id]) }}" class=""
                                           onclick="return confirm(this.getAttribute('data-message'));"
                                           data-message="{{ __('table.confirm_delete') }}">
                                            <i class="fa fa-trash-o text-danger button-2x"></i></a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <nav class="d-flex justify-content-between">
                        <span>{{ __('table.showed') }}: <b>{{ $pagination->count() }}</b></span>
                        {{ $pagination->links('pagination::bootstrap-4') }}
                        <span>{{ __('table.total') }}: <b>{{ $pagination->total() }}</b></span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection

