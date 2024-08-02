@extends('admin.layouts.main')
@section('content')
    <div class="d-flex justify-content-center">
        <div class="col-md-12 col-lg-8">
            <div class="card mb-5 mt-5 shadow-1">
                <div class="card-header">
                    <h4 class="card-header-title">
                        {{ __('form.permission.edit_permission') }}
                    </h4>
                </div>
                <div class="card-body collapse show" id="collapse8">
                    <form class="needs-validation" action="{{ route("permissions.update", [$item->id]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="name">{{ __('table.name') }}</label>
                                <input type="text" class="form-control" id="name" name="name" required value="{{ $item->name }}">
                                @if($errors->has('name'))
                                    <div class="text-danger">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-sm btn-success col-md-4" type="submit">{{ __('table.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

