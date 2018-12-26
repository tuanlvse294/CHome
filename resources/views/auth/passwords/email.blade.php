
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
                <form class="ui form" method="post" action="{{ route('password.email') }}">
                    {{csrf_field()}}
                    @include('ui.form.input',['name'=>'email','label'=>'Email *','type'=>'email'])

                    <button class="ui primary button" type="submit">Lập lại mật khẩu</button>
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