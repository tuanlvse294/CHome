@extends('layouts.blank')
@section('body_content')
    <body>
    <div class="ui vertical inverted menu"
         style="height: 100%;width:250px;margin-bottom: 0px;border-radius: 0px;position: fixed;top: 0px;">
        <div class="item">
            <a class="ui logo icon image" href="/">
                <img src="/images/logo.png" style="width: 40px;margin-right: 20px">
            </a>
            <a href="/"><b>Bảng quản trị</b></a>
        </div>

        @if(Auth::user()->has_role('admin'))
            <div class="item">
                <div class="header">Thống kê</div>
                <div class="menu">
                    <a class="item" href="{{route('dashboard')}}"><i class="inverted chart line icon"></i>Thống
                        kê truy cập</a>
                    <a class="item" href="{{route('revenue')}}"><i class="green money icon"></i>Thống kê doanh thu
                    </a>

                </div>
            </div>
            <div class="item">
                <div class="header">Quản trị</div>
                <div class="menu">
                    <a class="item" href="{{route('offers.manage_accept')}}"><i class="inverted check icon"></i>Xét
                        duyệt
                        tin rao vặt</a>
                    <a class="item" href="{{route('offers.manage')}}"><i class="inverted building icon"></i>Tin rao
                        vặt</a>
                    <a class="item" href="{{route('offers.trash')}}"><i class="grey building icon"></i>Tin rao vặt
                        đã ẩn</a>
                    <a class="item" href="{{route('users.manage')}}"><i class="inverted users icon"></i>Người
                        dùng</a>
                    <a class="item" href="{{route('users.trash')}}"><i class="grey users icon"></i>Người dùng đã ẩn</a>
                    <a class="item" href="{{route('transaction.manage')}}"><i class="green exchange icon"></i>Giao dịch</a>
                    <a class="item" href="{{route('premium.manage')}}"><i class="yellow star icon"></i>Gói tin đặc biệt</a>
                </div>
            </div>
        @elseif(Auth::user()->has_role('mod'))
            <div class="item">
                <div class="header">Quản trị</div>
                <div class="menu">
                    <a class="item" href="{{route('offers.manage_accept')}}"><i class="inverted check icon"></i>Xét
                        duyệt
                        tin rao vặt</a>
                    <a class="item" href="{{route('offers.manage')}}"><i class="inverted building icon"></i>Tin rao
                        vặt</a>
                    <a class="item" href="{{route('offers.trash')}}"><i class="grey building icon"></i>Tin rao vặt
                        đã ẩn</a>
                    <a class="item" href="{{route('premium.manage')}}"><i class="yellow star icon"></i>Gói tin đặc biệt</a>
                </div>
            </div>
        @endif
        <div class="item">
            <div class="header">Cá nhân</div>
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

