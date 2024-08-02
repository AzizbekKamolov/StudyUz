@extends('admin.layouts.main')
@section('content')
    <div class="d-flex justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="card mb-4 shadow-1">
                <div class="card-header">
                    <h4 class="card-header-title">
                        {{ __('form.role.edit_role') }}
                    </h4>
                </div>
                <div class="card-body collapse show" id="collapse8">
                    <form class="needs-validation" action="{{ route("roles.update", [$item->id]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="name">{{ __('table.name') }}</label>
                                <input type="text" class="form-control" id="name" name="name" required
                                       value="{{ $item->name }}">
                                @if($errors->has('name'))
                                    <div class="text-danger">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                            <div class="col-md-12 mb-3">
                                @foreach($permissions as $items)
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex justify-content-start">
                                            @foreach($items as $permission)
                                                <div>
                                                    <input type="checkbox" class="" name="permission_id[]"
                                                           @checked(in_array($permission['id'], array_column($item->permissions, 'id')))
                                                           id="{{ $permission['id'] }}" value="{{ $permission['name'] }}">
                                                    <label for="{{ $permission['id'] }}"
                                                           class="mr-4 ">{{ $permission['name'] }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="mb-2"><input type="checkbox"></div>
                                    </div>
                                    <br>
                                @endforeach
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

