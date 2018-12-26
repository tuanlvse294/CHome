@extends('layouts.default')

@section('content')
    <div class="ui container">
        <div class="ui breadcrumb">
            <a class="section" href="/">Trang chủ</a>
            <i class="right angle icon divider"></i>
            <span class="active section">Đăng ký</span>
        </div>


        <div class="ui stackable grid" style="margin-top: 20px">
            <div class="eight wide column">
                <div class="ui huge header">Đăng ký</div>
                @include('layouts.errors_block')
                @if (session('confirmation-success'))
                    <div class="ui segment">
                        <p>{{ session('confirmation-success') }}</p>
                    </div>
                @endif
                <form class="ui form" method="post" action="{{ route('register') }}">
                    {{csrf_field()}}
                    @include('ui.form.input',['name'=>'name','label'=>'Tên *'])
                    @include('ui.form.input',['name'=>'email','label'=>'Email *','type'=>'email'])
                    @include('ui.form.input',['name'=>'password','label'=>'Mật khẩu *','type'=>'password'])
                    @include('ui.form.input',['name'=>'password_confirmation','label'=>'Xác nhận mật khẩu *','type'=>'password'])
                    <button class="ui primary button" type="submit">Đăng ký</button>
                    <p><a href="/login">Đã có tài khoản? Đăng nhập ngay!</a></p>

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