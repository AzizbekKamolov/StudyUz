@extends('admin.layouts.main')
@section('content')
    <div class="row clearfix ht-100v">
        <div class="col-md-12 col-lg-12">
            <div class="card mb-4 shadow-1">
                <div class="card-header">
                    <h4 class="card-header-title">
                        Permission qo'shish
                    </h4>
{{--                    <div class="card-header-btn">--}}
{{--                        <a href="javascript:void(0)" data-toggle="collapse" class="btn btn-info" data-target="#collapse8" aria-expanded="true"><i class="ion-ios-arrow-down"></i></a>--}}
{{--                        <a href="javascript:void(0)" data-toggle="refresh" class="btn btn-warning"><i class="ion-android-refresh"></i></a>--}}
{{--                        <a href="javascript:void(0)" data-toggle="expand" class="btn btn-success"><i class="ion-android-expand"></i></a>--}}
{{--                        <a href="javascript:void(0)" data-toggle="remove" class="btn btn-danger"><i class="ion-ios-trash-outline"></i></a>--}}
{{--                    </div>--}}
                </div>
                <div class="card-body collapse show" id="collapse8">
                    <form class="needs-validation" novalidate="">
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="validationTooltip01">First name</label>
                                <input type="text" class="form-control" id="name" placeholder="First name" required="">
                                <div class="valid-tooltip">
                                    Looks good!
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationTooltip02">Last name</label>
                                <input type="text" class="form-control" id="validationTooltip02" placeholder="Last name" value="Otto" required="">
                                <div class="valid-tooltip">
                                    Looks good!
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationTooltipUsername">Username</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="validationTooltipUsernamePrepend">@</span>
                                    </div>
                                    <input type="text" class="form-control" id="validationTooltipUsername" placeholder="Username" aria-describedby="validationTooltipUsernamePrepend" value="swapan" required="">
                                    <div class="valid-tooltip">
                                        Looks Good!
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="validationTooltip03">City</label>
                                <input type="text" class="form-control" id="validationTooltip03" placeholder="City" required="">
                                <div class="invalid-tooltip">
                                    Please provide a valid city.
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationTooltip04">State</label>
                                <input type="text" class="form-control" id="validationTooltip04" placeholder="State" required="">
                                <div class="invalid-tooltip">
                                    Please provide a valid state.
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationTooltip05">Zip</label>
                                <input type="text" class="form-control" id="validationTooltip05" placeholder="Zip" required="">
                                <div class="invalid-tooltip">
                                    Please provide a valid zip.
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-sm btn-info" type="submit">Submit form</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

