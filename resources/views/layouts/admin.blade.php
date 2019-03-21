@extends('layouts.blank')
@section('body_content')
    <body>
    <div class="ui vertical inverted menu"
         style="height: 100%;width:250px;margin-bottom: 0px;border-radius: 0px;position: fixed;top: 0px;">
        <div class="item">
            <a class="ui logo icon image" href="/">
                <img src="/images/logo.png" style="width: 40px;margin-right: 20px">
            </a>
            <a href="/"><b>Admin panel</b></a>
        </div>
        <div class="item">
            <div class="header">Analytics</div>
            <div class="menu">
                <a class="item" href="{{route('dashboard')}}"><i class="inverted chart line icon"></i>Thống
                    kê</a>
            </div>
        </div>
        <div class="item">
            <div class="header">Manage</div>
            <div class="menu">
                <a class="item" href="{{route('offers.manage')}}"><i class="inverted building icon"></i>Tin rao
                    vặt</a>
                <a class="item" href="{{route('offers.trash')}}"><i class="grey building icon"></i>Tin rao vặt
                    đã ẩn</a>
                <a class="item" href="{{route('users.manage')}}"><i class="inverted users icon"></i>Người
                    dùng</a>
                <a class="item" href="{{route('users.trash')}}"><i class="grey users icon"></i>Người dùng đã ẩn</a>
            </div>
        </div>
        <div class="item">
            <div class="header">Settings</div>
            <div class="menu">
                <a class="item" href="{{route('setting')}}"><i class="yellow settings icon"></i>Cài đặt</a>
            </div>
        </div>
        <div class="item">
            <div class="header">Profile</div>
            <div class="menu">
                <a class="item" href="{{route('password.edit.admin')}}"><i class="grey user secret icon"></i>Đổi mật
                    khẩu</a>
                <a class="item" href="{{route('logout.get')}}"><i class="red sign out icon"></i>Đăng xuất</a>
            </div>
        </div>
    </div>
    <div style="padding-right: 28px;margin-left:280px">
        <br>
        @yield('content')
    </div>
    </body>
@endsection

