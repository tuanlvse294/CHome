{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--<div class="container">--}}
    {{--<div class="row justify-content-center">--}}
        {{--<div class="col-md-8">--}}
            {{--<div class="card">--}}
                {{--<div class="card-header">{{ __('Reset Password') }}</div>--}}

                {{--<div class="card-body">--}}
                    {{--<form method="POST" action="{{ route('password.request') }}">--}}
                        {{--@csrf--}}

                        {{--<input type="hidden" name="token" value="{{ $token }}">--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Địa chỉ') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>--}}

                                {{--@if ($errors->has('email'))--}}
                                    {{--<span class="invalid-feedback">--}}
                                        {{--<strong>{{ $errors->first('email') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>--}}

                                {{--@if ($errors->has('password'))--}}
                                    {{--<span class="invalid-feedback">--}}
                                        {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="password-confirm" type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" required>--}}

                                {{--@if ($errors->has('password_confirmation'))--}}
                                    {{--<span class="invalid-feedback">--}}
                                        {{--<strong>{{ $errors->first('password_confirmation') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row mb-0">--}}
                            {{--<div class="col-md-6 offset-md-4">--}}
                                {{--<button type="submit" class="btn btn-primary">--}}
                                    {{--{{ __('Reset Password') }}--}}
                                {{--</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
{{--@endsection--}}



@extends('layouts.default')

@section('content')
    <div class="ui container">
        <div class="ui breadcrumb">
            <a class="section" href="/">Trang chủ</a>
            <i class="right angle icon divider"></i>
            <span class="active section">Lập lại mật khẩu</span>
        </div>

        <div class="ui stackable grid" style="margin-top: 20px">
            <div class="eight wide column">
                <div class="ui huge header">Lập lại mật khẩu</div>
                @include('layouts.errors_block')
                @if (session('status'))
                    <div class="ui segment">
                        <p>  {!! session('status') !!}</p>
                    </div>
                @endif
                <form class="ui form" method="post" action="{{ route('password.request') }}">
                    {{csrf_field()}}
                    <input type="hidden" name="token" value="{{ $token }}">

                    @include('ui.form.input',['name'=>'email','label'=>'Email *','type'=>'email'])
                    @include('ui.form.input',['name'=>'password','label'=>'New password *','type'=>'password'])
                    @include('ui.form.input',['name'=>'password_confirmation','label'=>'Confirm Mật khẩu *','type'=>'password'])

                    <button class="ui primary button" type="submit">Reset Mật khẩu</button>
                    <p><a href="/register">Không có tài khoản? Đăng ký ngay!</a></p>

                </form>
            </div>
            <div class="four wide column">
                <h3 class="ui dividing header">Theo dõi chúng tôi trên</h3>
                <p>Theo dõi kênh của chúng tôi </p>
                <a href="#"><i class="huge facebook icon"></i> </a>
                <a href="#"><i class="huge red google icon"></i> </a>
                <a href="#"><i class="huge blue twitter icon"></i> </a>
            </div>
        </div>
    </div>
@endsection