@extends('auth.layout')
@section('content')
    <div >
        <div class="mg-y-120">
            <div class="card mx-auto wd-350 text-center pd-25 shadow-3">
                <h4 class="card-title mt-3 text-center">Sing In</h4>
                <p class="text-center">Sing in to your account</p>
                {{--            <p>--}}
                {{--                <a href="" class="btn btn-block btn-twitter tx-13 hover-white"> <i class="fa fa-twitter"></i>   Login via Twitter</a>--}}
                {{--                <a href="" class="btn btn-block btn-facebook tx-13 hover-white"> <i class="fa fa-facebook-f"></i>   Login via facebook</a>--}}
                {{--            </p>--}}
                {{--            <p class="divider-text">--}}
                {{--                <span class="bg-light">OR</span>--}}
                {{--            </p>--}}
                <form method="post" action="{{ route('auth.login') }}">
                    @csrf
                    @if($errors->has('username'))
                        <span class="text-danger">{{ $errors->first('username') }}</span>
                    @endif
                    <div class="form-group input-group mb-4 mt-0">
                        <div class="input-group-prepend">
                            <span class="input-group-text pd-x-9 text-muted"> <i class="fa fa-envelope"></i> </span>
                        </div>
                        <input class="form-control" placeholder="Email address" type="text" name="username" value="{{ old('username') }}">
                    </div>
                    @if($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                    <div class="form-group input-group mb-5">
                        <div class="input-group-prepend">
                            <span class="input-group-text text-muted"> <i class="fa fa-lock"></i> </span>
                        </div>
                        <input class="form-control" placeholder="Create password" type="password" name="password">
                    </div>
                    <p class="text-center"><a href="page-password.html">Forget Password?</a></p>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info btn-block tx-13 hover-white"> Login </button>
                    </div>
                    <p class="text-center">Don't have an account? <a href="page-singup.html">Create Account</a> </p>
                </form>
            </div>
        </div>
    </div>
@endsection
