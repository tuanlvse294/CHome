@extends('layouts.default')

@section('content')
    <div class="ui container">
        <div class="ui breadcrumb">
            <a class="section" href="/">Trang chủ</a>
            <i class="right angle icon divider"></i>
            <span class="active section">Đổi mật khẩu</span>
        </div>

        <div class="ui grid" style="margin-top: 20px">
            <div class="eight wide column">
                <div class="ui huge header">Đổi mật khẩu</div>
                @include('layouts.errors_block')
                <form class="ui form" method="post" action="{{route('password.save')}}">
                    {{csrf_field()}}
                    @include('ui.form.input',['name'=>'old_password','label'=>'Mật khẩu cũ ','type'=>'password'])
                    @include('ui.form.input',['name'=>'new_password','label'=>'Mật khẩu mới','type'=>'password'])
                    @include('ui.form.input',['name'=>'new_password_confirmation','label'=>'Xác nhận mật khẩu mới','type'=>'password'])
                    <button class="ui primary button" type="submit">Đổi</button>
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