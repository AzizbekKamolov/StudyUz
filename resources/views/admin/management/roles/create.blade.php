@extends('admin.layouts.main')
@section('content')
    <div class="row clearfix ht-100v">
        <div class="col-md-12 col-lg-12">
            <div class="card mb-4 shadow-1">
                <div class="card-header">
                    <h4 class="card-header-title">
                        {{ __('form.role.add_role') }}
                    </h4>
                </div>
                <div class="card-body collapse show" id="collapse8">
                    <form class="needs-validation" action="{{ route("roles.store") }}" method="post">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="name">{{ __('table.name') }}</label>
                                <input type="text" class="form-control" id="name" name="name" required value="{{ old('name') }}">
                                @if($errors->has('name'))
                                    <div class="text-danger">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                            <div class="col-md-12 mb-3">
                                @foreach($permissions as $items)
                                    @foreach($items as $permission)
                                            <input type="checkbox" class="" name="permission_id[]" id="{{ $permission->id }}" value="{{ $permission->name }}">
                                            <label for="{{ $permission->id }}" class="mr-2 ">{{ $permission->name }}</label>
                                    @endforeach
                                        <br>
                                @endforeach
                            </div>
                        </div>
                        <button class="btn btn-sm btn-info" type="submit">{{ __('table.save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
