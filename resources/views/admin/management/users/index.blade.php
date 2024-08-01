@extends('admin.layouts.main')
@section('content')
    <div class="row clearfix @if(count($pagination->items()) <= 8) ht-100v @endif">
        <div class="col-md-12 col-lg-12">
            <div class="card mb-4 shadow-1">
                <div class="card-header">
                    <h4 class="card-header-title">
                        {{ __('form.user.users') }}
                    </h4>
                    <a href="{{ route("users.create") }}" class="btn btn-outline-success">
                        <i class="fa fa-plus button-2x"> {{ __('table.add') }}</i></a>
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

