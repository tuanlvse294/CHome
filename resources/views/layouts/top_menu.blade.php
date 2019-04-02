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
                    <i class=" red bell icon"></i> Thông báo ({{Auth::user()->new_notifications()->count()}})
                    <i class="dropdown icon"></i>
                    <div class="menu">
                        @foreach(Auth::user()->all_notifications()->limit(5)->get() as $notification)
                            <a class="item" href="{{route('users.show_notification',['notification'=>$notification])}}"
                               @if(!$notification->seen)
                               style="color: red !important;"
                                    @endif
                            ><i
                                        class="newspaper icon"></i>
                                {{$notification->title}}</a>
                        @endforeach
                        <a class="red item" href="{{route('users.notifications')}}"><i
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
                        <a class="item" href="{{route('users.transactions')}}"><i class="money icon"></i>
                            Giao dịch của tôi</a>
                        <a class="item" href="{{route('users.mine')}}"><i class="building icon"></i>
                            Tin đăng của tôi</a>
                        <a class="item" href="{{route('users.premiums')}}"><i class="star icon"></i>
                            Tin đặc biệt của tôi</a>
                        <a class="item" href="{{route('users.pending')}}"><i class="green check icon"></i>
                            Tin đăng chờ duyệt của tôi</a>
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