<div class="ui stackable  menu" style="background: #f7f7f7">
    <div class="ui container">

        <div class="left menu">
            <a class="item" href="/">
                <b>C-Home.net</b>
            </a>
        </div>


        <div class="right menu">
            <div class="item">
                <a href="{{route('offers.create')}}" class="ui yellow button">
                    <i class="edit icon"></i> Đăng tin mới
                </a>
            </div>

            <div class="ui dropdown item"><i class="user icon"></i>
                {{Auth::check()?Auth::user()->name:'Tài khoản'}}
                <i class="dropdown icon"></i>
                <div class="menu">
                    @if(Auth::check())
                        {{--<a class="item" href="/profile/wishlist">Danh sách yêu thích</a>--}}
                        <a class="item" href="{{route('info.edit')}}">Sửa thông tin cá nhân</a>
                        <a class="item" href="{{route('password.edit')}}">Đổi mật khẩu</a>
                        <a class="item" href="{{route('logout.get')}}">Đăng xuất</a>
                    @else
                        <a class="item" href="{{route('login')}}">Đăng nhập</a>
                        <a class="item" href="{{route('register')}}">Đăng ký</a>
                    @endif

                </div>
            </div>

            @if(Auth::check()&&Auth::user()->has_role('admin'))
                <div class="ui dropdown item">
                    <div class="header"><i class="list icon"></i>Quản lý</div>
                    <i class="dropdown icon"></i>
                    <div class="menu">
                        <a class="item" href="{{route('offers.manage')}}">Tin rao vặt</a>
                        <a class="item" href="{{route('offers.trash')}}">Tin rao vặt đã xoá</a>
                        <a class="item" href="{{route('users.manage')}}">Người dùng</a>
                        <a class="item" href="{{route('users.trash')}}">Người dùng đã xoá</a>
                        <a class="item" href="{{route('setting')}}">Cài đặt</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>