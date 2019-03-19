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
            @if(Auth::check())

                <div class="ui dropdown item">
                    <i class=" red bell icon"></i> Thông báo ({{Auth::user()->my_notifications()->count()}})
                    <i class="dropdown icon"></i>
                    <div class="menu">
                        <a class="red item" href="{{route('users.notications')}}"><i
                                    class="list icon"></i>
                            Xem tất cả thông báo</a>
                    </div>
                </div>
            @endif

            <div class="ui dropdown item"><i class="user icon"></i>
                {{Auth::check()?Auth::user()->name:'Tài khoản'}}
                <i class="dropdown icon"></i>
                <div class="menu">
                    @if(Auth::check())
                        <a class="item" href="{{route('users.show',['id'=>\Auth::id()])}}"><i class="building icon"></i>
                            Tin đăng của tôi</a>
                        <a class="item" href="{{route('users.liked')}}"><i class="star icon"></i> Danh sách yêu
                            thích</a>
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
        </div>
    </div>
</div>