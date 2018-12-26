<div class="ui stackable  menu" style="background: #f7f7f7">
    <div class="ui container">

        <div class="left menu">
            <a class="item" href="/">
                <b >C-Home.net</b>
            </a>
        </div>


        <div class="right menu">
            <div class="item" href="/cart">
                <a href="/offers/create" class="ui yellow button">
                    <i class="edit icon"></i> Đăng tin mới
                </a>
            </div>

            <div class="ui dropdown item"><i class="user icon"></i>
                {{Auth::check()?Auth::user()->name:'Tài khoản'}}
                <i class="dropdown icon"></i>
                <div class="menu">
                    @if(Auth::check())
                        <a class="item" href="/orders">Xem đơn hàng</a>
                        <a class="item" href="/profile/wishlist">Danh sách yêu thích</a>
                        <a class="item" href="/profile/info">Sửa thông tin cá nhân</a>
                        <a class="item" href="/profile/password">Đổi mật khẩu</a>
                        <a class="item" href="/logout">Đăng xuất</a>
                    @else
                        <a class="item" href="/login">Đăng nhập</a>
                        <a class="item" href="/register">Đăng ký</a>
                    @endif

                </div>
            </div>

            @if(Auth::check()&&Auth::user()->is_admin)
                <div class="ui dropdown item">
                    <div class="header">Quản lý</div>
                    <i class="dropdown icon"></i>
                    <div class="menu">
                        <a class="item" href="/statistics">Thống kê</a>
                        <a class="item" href="/manage/products">Sản phẩm</a>
                        <a class="item" href="/manage/categories">Danh mục</a>
                        <a class="item" href="/manage/users">Người dùng</a>
                        <a class="item" href="/manage/orders">Đơn hàng <span class="ui red label"
                                                                             style="margin-left: 20px">{{\App\Order::whereStatus('wait_confirm')->count()}}</span></a>
                        <a class="item" href="/manage/ads">Quảng cáo</a>
                        <a class="item" href="/manage/discounts">Mã giảm giá</a>
                        <a class="item" href="/manage/blogs">Bài viết</a>
                        <a class="item" href="/manage/settings">Cài đặt</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>