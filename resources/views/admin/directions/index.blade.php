@extends('admin.layouts.main')
@section('content')
    <div class="row clearfix">
        <div class="col-md-12 col-lg-12">
            <div class="card mb-4 shadow-1">
                <div class="card-header">
                    <div class="card-header-title">
                        <h5><a href="{{ route('directions.index') }}">{{ __('form.direction.directions') }}</a>
                        </h5>
                    </div>
                    @can('directions.store')
                        <a href="{{ route("directions.create") }}" class="btn btn-outline-success">
                            <i class="fa fa-plus button-2x"> {{ __('table.add') }}</i></a>
                    @endcan
                </div>

                <div class="card-body">
                    <table class="table table-striped table-responsive-sm">
                        <thead>
                        <tr>
                            <form action="{{ route("directions.index") }}">
                                <td></td>
                                <td>
                                    <select class="form-control select2 select2-hidden-accessible" name="limit"
                                            style="width: 65px">
                                        <option value="5" @selected(request('limit') == 5)>5</option>
                                        <option
                                            value="10" @selected(request('limit') == 10 || is_null(request('limit')))>10
                                        </option>
                                        <option value="20" @selected(request('limit') == 20)>20</option>
                                        <option value="30" @selected(request('limit') == 30)>30</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control" name="name"
                                           placeholder="{{ __('table.name') }}"
                                           value="{{ request('name') }}">
                                </td>
                                <td>
                                    <input class="form-control" type="text" name="contract_currency"
                                           placeholder="{{ __('form.direction.contract_currency') }}" value="{{ request('contract_currency') }}">
                                </td>
                                <td>
                                    <select class="form-control select2 select2-hidden-accessible" tabindex="-1"
                                            aria-hidden="true" id="university_id" name="university_id">
                                        <option value="" selected
                                                disabled>{{ __('form.university.university') }} {{ __('table.choose') }}</option>
                                        @foreach($universities as $university)
                                            <option
                                                value="{{ $university->id }}"
                                                @selected(request('university_id') == $university->id)>
                                                {{ $university->nameTr ?? $university->name_uz }}</option>
                                        @endforeach
                                    </select></td>
                                <td>
                                    <div class="col">
                                        <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                                        <a href="{{ route('directions.index') }}" class="btn btn-outline-info"><i
                                                class="fa fa-refresh"></i></a>
                                    </div>
                                </td>
                            </form>
                        </tr>

                        <tr>
                            <th>#</th>
                            <th>{{ __('table.name') }}</th>
                            <th>{{ __('form.direction.requirement') }}</th>
                            <th>{{ __('form.direction.contract_amount') }}</th>
                            <th>{{ __('form.university.university') }}</th>
                            <th>{{ __('table.actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pagination->items() as $item)
                            <tr>
                                <th scope="row">{{ ($pagination->currentpage()-1) * $pagination->perpage() + $loop->index + 1 }}</th>
                                <td>{{ $item->nameTr }}</td>
                                <td>{!! $item->requirementTr !!}</td>
                                <td>{{ $item->contract_amount . " ($item->contract_currency_tr)" }}</td>
                                <td>{{ $item->universityName }}</td>
                                <td>
                                    @can('directions.update')
                                        <a href="{{ route("directions.edit", [$item->id]) }}">
                                            <i class="fa fa-edit text-purple button-2x"></i></a>
                                    @endcan
                                    {{--                                    <a href="">--}}
                                    {{--                                        <i class="fa fa-eye text-info button-2x"></i></a>--}}
                                    @can('directions.delete')
                                        <a href="{{ route("directions.delete", [$item->id]) }}" class=""
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
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            // Event handler for the button click
            $("#country_id").change(function (e) {
                $("#city_id").html(`<option value="" selected disabled>{{ __('form.city.city') }} {{ __('table.choose') }}</option>`);
                // Make an AJAX request
                $.ajax({
                    url: '{{ route('cities.getCitiesByCountryId') }}?country_id=' + e.target.value, // Sample API endpoint
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        // Update the content on success
                        console.log(data.data)
                        let items = `<option value="" selected
                                                disabled>{{ __('form.country.country') }} {{ __('table.choose') }}</option>`
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
    </script>
@endsection
