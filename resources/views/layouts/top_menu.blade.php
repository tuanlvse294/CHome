<div class="ui stackable  menu" style="background: #f7f7f7">
    <div class="ui container">

        <div class="left menu">
            <a class="item" href="/">
                <img src="/images/logo.png" alt="">
            </a>
        </div>


        <div class="right menu">
            <div class="item">
                <a href="{{route('offers.create')}}" class="ui orange button">
                    <i class="edit icon"></i> Đăng tin mới
                </a>
            </div>

            <div class="ui dropdown item"><i class="user icon"></i>
                {{Auth::check()?Auth::user()->name:'Tài khoản'}}
                <i class="dropdown icon"></i>
                <div class="menu">
                    @if(Auth::check())
                        {{--<a class="item" href="/profile/wishlist">Danh sách yêu thích</a>--}}
                        <a class="item" href="{{route('info.edit')}}"><i class="blue info icon"></i>Sửa thông tin cá
                            nhân</a>
                        <a class="item" href="{{route('password.edit')}}"><i class="grey user secret icon"></i>Đổi mật
                            khẩu</a>
                        <a class="item" href="{{route('logout.get')}}"><i class="red sign out icon"></i>Đăng xuất</a>
                    @else
                        <a class="item" href="{{route('login')}}"><i class="red sign in icon"></i>Đăng nhập</a>
                        <a class="item" href="{{route('register')}}"><i class="blue plus icon"></i>Đăng ký</a>
                    @endif

                </div>
            </div>

            @if(Auth::check()&&Auth::user()->has_role('admin'))
                <div class="ui dropdown item">
                    <div class="header"><i class="orange dashboard icon"></i> Quản lý</div>
                    <i class="dropdown icon"></i>
                    <div class="menu">
                        <a class="item" href="{{route('dashboard')}}"><i class="green chart line icon"></i>Thống kê</a>
                        <a class="item" href="{{route('offers.manage')}}"><i class="blue building icon"></i>Tin rao vặt</a>
                        <a class="item" href="{{route('offers.trash')}}"><i class="grey building icon"></i>Tin rao vặt
                            đã xoá</a>
                        <a class="item" href="{{route('users.manage')}}"><i class="blue users icon"></i>Người dùng</a>
                        <a class="item" href="{{route('users.trash')}}"><i class="grey users icon"></i>Người dùng đã xoá</a>
                        <a class="item" href="{{route('setting')}}"><i class="yellow settings icon"></i>Cài đặt</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>