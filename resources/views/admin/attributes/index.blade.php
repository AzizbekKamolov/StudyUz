@extends('admin.layouts.main')
@section('content')
    <div class="row clearfix">
        <div class="col-md-12 col-lg-12">
            <div class="card mb-4 shadow-1">
                <div class="card-header">
                    <div class="card-header-title">
                        <h5><a href="{{ route('attributes.index') }}">{{ __('form.attribute.attributes') }}</a>
                        </h5>
                    </div>
                    @can('attributes.store')
                        <a href="{{ route("attributes.create") }}" class="btn btn-outline-success">
                            <i class="fa fa-plus button-2x"> {{ __('table.add') }}</i></a>
                    @endcan
                </div>

                <div class="card-body">
                    <table class="table table-striped table-responsive-sm">
                        <thead>
                        <tr>
                            <form action="{{ route("attributes.index") }}">
                                <td>
                                    <select class="form-control select2 select2-hidden-accessible" name="limit" style="width: 65px">
                                        <option value="5" @selected(request('limit') == 5)>5</option>
                                        <option value="10" @selected(request('limit') == 10 || is_null(request('limit')))>10</option>
                                        <option value="20" @selected(request('limit') == 20)>20</option>
                                        <option value="30" @selected(request('limit') == 30)>30</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control" name="name"
                                           placeholder="{{ __('table.name') }}"
                                           value="{{ request('name') }}"
                                    ></td>
                                <td>
                                    <select class="form-control select2 select2-hidden-accessible" tabindex="-1"
                                            aria-hidden="true" id="type" name="type">
                                        <option value="" selected>{{ __('form.university.university') }}</option>
                                        <option value="1">{{ __('form.university.university') }}</option>
                                        <option value="2">{{ __('form.direction.direction') }}</option>
                                    </select>
                                </td>
                                <td></td>
                                <td>
                                    <div class="col">
                                        <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                                        <a href="{{ route('attributes.index') }}" class="btn btn-outline-info"><i
                                                class="fa fa-refresh"></i></a>
                                    </div>
                                </td>
                            </form>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>{{ __('table.name') }}</th>
                            <th>{{ __('form.attribute.type') }}</th>
                            <th>{{ __('table.created_at') }}</th>
                            <th>{{ __('table.actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pagination->items() as $item)
                            <tr>
                                <th scope="row">{{ ($pagination->currentpage()-1) * $pagination->perpage() + $loop->index + 1 }}</th>
                                <td>{{ $item->nameTr }}</td>
                                <td>{{ $item->typeName }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    @can('attributes.update')
                                        <a href="{{ route("attributes.edit", [$item->id]) }}">
                                            <i class="fa fa-edit text-purple button-2x"></i></a>
                                    @endcan
                                    {{--                                    <a href="">--}}
                                    {{--                                        <i class="fa fa-eye text-info button-2x"></i></a>--}}
                                    @can('attributes.delete')
                                        <a href="{{ route("attributes.delete", [$item->id]) }}" class=""
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
