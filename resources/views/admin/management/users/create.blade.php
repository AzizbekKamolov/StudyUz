@extends('admin.layouts.main')
@section('content')
    <div class="d-flex justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card mb-4 shadow-1">
                <div class="card-header">
                    <h4 class="card-header-title">
                        {{ __('form.user.add_user') }}
                    </h4>
                </div>
                <div class="card-body collapse show" id="collapse8">
                    <form class="needs-validation" action="{{ route("users.store") }}" method="post">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="first_name">{{ __('form.common.first_name') }}</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" required value="{{ old('first_name') }}">
                                @if($errors->has('first_name'))
                                    <div class="text-danger">{{ $errors->first('first_name') }}</div>
                                @endif
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="last_name">{{ __('form.common.last_name') }}</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" required value="{{ old('last_name') }}">
                                @if($errors->has('last_name'))
                                    <div class="text-danger">{{ $errors->first('last_name') }}</div>
                                @endif
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="middle_name">{{ __('form.common.middle_name') }}</label>
                                <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{ old('middle_name') }}">
                                @if($errors->has('name'))
                                    <div class="text-danger">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone">{{ __('form.common.phone') }}</label>
                                <input type="text" class="form-control" id="phone" name="phone" required value="{{ old('phone') }}">
                                @if($errors->has('phone'))
                                    <div class="text-danger">{{ $errors->first('phone') }}</div>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email">{{ __('form.common.email') }}</label>
                                <input type="email" class="form-control" id="email" name="email" required value="{{ old('email') }}">
                                @if($errors->has('email'))
                                    <div class="text-danger">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password">{{ __('form.common.password') }}</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                                @if($errors->has('password'))
                                    <div class="text-danger">{{ $errors->first('password') }}</div>
                                @endif
                            </div>
{{--                            @dd($errors)--}}
                            <div class="col-md-6 mb-3">
                                <label for="role_id">{{ __('form.role.role') }}</label>
                                <select class="form-control select2 select2-hidden-accessible" data-placeholder="Choose country" tabindex="-1" aria-hidden="true" id="role_id" name="role_id[]">
                                   @foreach($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('role_id'))
                                    <div class="text-danger">{{ $errors->first('role_id') }}</div>
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

