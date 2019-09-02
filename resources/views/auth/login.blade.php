@extends('layouts.app2')

@section('content')
<div class="container col-md-8 h-100" >

    <div class="row justify-content-center align-items-lg-center h-100 ">
        <div class="col-md-7" >
            <div class="card card-white card-login">

                <div class="card-header bg-gradient-primary pt-3 pb-5">
                   <h3 class="text-white mb-0"> {{ __('Login') }} </h3>
                    <span> HANTA ERP V1.0</span>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                            <div class="input-group col-md-10 offset-md-1">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="tim-icons icon-single-02"></i>
                                    </div>
                                </div>
                                <input id="username"  type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" placeholder="{{__('Username')}}" name="username" value="{{ old('username') }}" required autofocus>
                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>

                        <div class="input-group col-md-10 offset-md-1">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="tim-icons icon-key-25"></i>
                                </div>
                            </div>
                            <input id="password"  type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{__('Password')}}" name="password"  required autofocus>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    //خطای پسورد رو نشون میدهد//
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>

                        {{--<div class="form-group row">--}}
                            {{--<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>--}}

                                {{--@if ($errors->has('password'))--}}
                                    {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row">--}}
                            {{--<div class="col-md-6 offset-md-4">--}}
                                {{--<div class="form-check">--}}
                                    {{--<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

                                    {{--<label class="form-check-label" for="remember">--}}
                                        {{--{{ __('Remember Me') }}--}}
                                    {{--</label>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        <div class="form-group row mb-0">
                            <div class="col-md-4 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Login') }}
                                </button>
                            </div>


                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-4 offset-md-4">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link pm-md-0 mb-0" href="{{ route('password.request') }}">
                                    <small>
                                        {{ __('Forgot Your Password?') }}
                                    </small>
                                </a>
                        @endif
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <div class="copyright text-center">
                ©2018 <a href=http://hantaibms.com >Hantaibms</a> Co. by EBD
            </div>
        </div>
    </div>

    {{--<footer class="footer justify-content-center">--}}
        {{--<div class="float-left col-md-7 col-sm-12" >--}}
            {{--<div class="copyright">--}}
                {{--©2018 <a href=http://hantaibms.com >Hantaibms</a> Co. by EBD--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</footer>--}}

</div>


@endsection
