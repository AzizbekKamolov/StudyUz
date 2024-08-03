@extends('admin.layouts.main')
@section('content')
    <div class="d-flex justify-content-center">
        <div class="col-md-10 col-lg-10">
            <div class="card mb-4 shadow-1">
                <div class="card-header">
                    <h4 class="card-header-title">
                        {{ __('form.user.edit_user') }}
                    </h4>
                </div>
                <div class="card-body collapse show" id="collapse8">
                    <form class="needs-validation" action="{{ route("users.update", [$item->id]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="first_name">logo</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" required value="{{ $item->first_name }}">
                                @if($errors->has('first_name'))
                                    <div class="text-danger">{{ $errors->first('first_name') }}</div>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="last_name">{{ __('form.common.last_name') }}</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" required value="{{ $item->last_name }}">
                                @if($errors->has('last_name'))
                                    <div class="text-danger">{{ $errors->first('last_name') }}</div>
                                @endif
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="middle_name">{{ __('form.common.middle_name') }}</label>
                                <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{ $item->middle_name }}">
                                @if($errors->has('middle_name'))
                                    <div class="text-danger">{{ $errors->first('middle_name') }}</div>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone">{{ __('form.common.phone') }}</label>
                                <input type="text" class="form-control" id="phone" name="phone" required value="{{ $item->phone }}">
                                @if($errors->has('phone'))
                                    <div class="text-danger">{{ $errors->first('phone') }}</div>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email">{{ __('form.common.email') }}</label>
                                <input type="email" class="form-control" id="email" name="email" required value="{{ $item->email }}">
                                @if($errors->has('email'))
                                    <div class="text-danger">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password">{{ __('form.common.password') }}</label>
                                <input type="password" class="form-control" id="password" name="password">
                                @if($errors->has('password'))
                                    <div class="text-danger">{{ $errors->first('password') }}</div>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="role_id">{{ __('form.role.roles') }}</label>
                                <select class="form-control select2 select2-hidden-accessible" data-placeholder="Choose country" tabindex="-1" aria-hidden="true" id="role_id" name="role_id[]">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}"
                                        @foreach($item->roles as $userRole)
                                            @selected($userRole['id'] === $role->id)
                                        @endforeach
                                        >{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('password'))
                                    <div class="text-danger">{{ $errors->first('password') }}</div>
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

