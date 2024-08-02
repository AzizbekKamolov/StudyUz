@extends('admin.layouts.main')
@section('content')
    <div class="row clearfix">
        <div class="col-md-12 col-lg-12">
            <div class="card mb-4 shadow-1">
                <div class="card-header">
                    <div class="card-header-title d-flex justify-content-between">
                        <h4><a href="{{ route('users.index') }}">{{ __('form.user.users') }}</a></h4>
                        <div>
                            <form action="{{ route('users.index') }}">
                                <div class="row">
                                    <div class="col">
                                        <input type="text" class="form-control" name="search" placeholder="{{ __('table.search') }}">
                                    </div>
                                    <div class="col">
                                        <select class="form-control"  name="role_id">
                                            <option value="" disabled selected>{{ __('form.role.role') }} {{ __('table.choose') }}</option>
                                        @foreach($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <a href="{{ route("users.create") }}" class="btn btn-outline-success">
                            <i class="fa fa-plus button-2x"> {{ __('table.add') }}</i></a>
                    </div>
{{--                    <h4 class="card-header-title">--}}
{{--                        {{ __('form.user.users') }}--}}
{{--                    </h4>--}}

                </div>
                <div class="card-body collapse show" id="collapse2">
                    <table class="table table-striped table-responsive-sm">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('form.common.last_name') }}</th>
                            <th>{{ __('form.common.first_name') }}</th>
                            <th>{{ __('form.common.phone') }}</th>
                            <th>{{ __('form.common.email') }}</th>
                            <th>{{ __('form.role.roles') }}</th>
                            <th>{{ __('table.actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pagination->items() as $item)
                            <tr>
                                <th scope="row">{{ ($pagination->currentpage()-1) * $pagination->perpage() + $loop->index + 1 }}</th>
                                <td>{{ $item->last_name }}</td>
                                <td>{{ $item->first_name }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    @foreach($item->roles as $userRole)
                                        <span class="badge badge-success">{{ $userRole['name'] }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ route("users.edit", [$item->id]) }}">
                                        <i class="fa fa-edit text-purple button-2x"></i></a>
                                    <a href="">
{{--                                        <i class="fa fa-eye text-info button-2x"></i></a>--}}
                                    <a href="{{ route("users.delete", [$item->id]) }}" class=""
                                       onclick="return confirm(this.getAttribute('data-message'));"
                                       data-message="{{ __('table.confirm_delete') }}">
                                        <i class="fa fa-trash-o text-danger button-2x"></i></a>
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

