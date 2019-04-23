<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Notification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Response;

//user's editing profile controller
class UserController extends Controller
{
    //admin see all the users
    public function manage()
    {
        return view('user.list', ['items' => User::all(), 'title' => 'Quản lý người dùng']);
    }

    //admin see all the banned users
    public function trash()
    {
        return view('user.list', ['items' => User::onlyTrashed()->get(), 'title' => 'Quản lý người dùng đã xoá', 'trash' => true]);
    }

    //admin ban a  user
    public function delete(User $user)
    {
        \Session::flash("message", "Đã xoá tài khoản " . $user->email);
        $user->delete();
        return redirect()->back();
    }

    //show offers of any user
    public function show(User $user)
    {
        return view('offer.show', ['items' => $user->offers()->paginate(10), 'title' => 'Tin đăng của ' . $user->name, 'user' => $user]);
    }


    //show my offers
    public function show_mine()
    {
        return view('offer.mine', ['items' => \Auth::user()->non_premium_offers()->get(), 'title' => 'Tin đăng thường của tôi', 'user' => \Auth::user()]);
    }

    //show my pending offers

    public function show_pending()
    {
        return view('offer.mine', ['items' => \Auth::user()->pending_offers()->get(), 'title' => 'Tin đăng chờ duyệt của ' . \Auth::user()->name, 'user' => \Auth::user()]);
    }

    public function show_premium()
    {
        return view('offer.mine', ['items' => \Auth::user()->premium_offers()->get(), 'title' => 'Tin đặc biệt của tôi', 'user' => \Auth::user()]);
    }

    //show my liked offers

    public function liked()
    {
        return view('offer.liked_list', ['offers' => \Auth::user()->liked_offers()->paginate(10), 'title' => 'Danh sách yêu thích']);
    }

    public function show_notification(Notification $notification)
    {
        $notification->seen = true;
        $notification->save();
        return redirect($notification->url);
    }

    public function notifications()
    {
        return view('user.notifications', ['notifications' => \Auth::user()->all_notifications()->paginate(10), 'title' => 'Tất cả thông báo']);
    }


    public function my_transactions()
    {
        return view('transaction.list', ['transactions' => Auth::user()->transactions, 'title' => 'Tất cả giao dịch']);
    }

    //admin export all users data
    public function export_csv()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    //admin unban a user
    public function restore($user)
    {
        $user = User::withTrashed()->find($user);
        $user->restore();
        \Session::flash("message", "Khôi phục tài khoản " . $user->email);
        return redirect()->back();
    }

    //admin permanently delete a user
    public function force_delete($user)
    {
        $user = User::withTrashed()->find($user);
        \Session::flash("message", "Đã xoá vĩnh viễn tài khoản " . $user->email);
        $user->forceDelete();
        return redirect()->back();
    }

//show all user's info
    public function edit_info(Request $request)
    {
        \Auth::user()->fill_olds();
        return view('user.info');
    }

//save edited info
    public function save_info(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric|min:10',
            'address' => 'required|string',
        ]);
        \Auth::user()->fill($request->all());
        \Auth::user()->save();

        \Session::flash('message', 'Đã đổi thông tin cá nhân!');

        return redirect(route('info.edit'));
    }

    public function edit_permission(Request $request, User $user)
    {
        $title = 'Chỉnh sửa quyền hạn';
        return view('user.permission', compact('title', 'user'));
    }

    public function save_permission(Request $request, User $user)
    {
        $request->validate([
            'roles' => 'required',
        ]);
        $user->roles = json_encode($request->get('roles')); //roles come in as a array of selected roles
        $user->save();
        \Session::flash('message', 'Đã lưu quyền hạn!');
        return redirect(route('users.edit_permission', compact('user')));
    }

//change password page
    public function edit_password(Request $request)
    {
        return view('user.password');
    }

    public function edit_password_admin(Request $request)
    {
        return view('user.password_admin');
    }

//save new password
    public
    function save_password(Request $request)
    {
        //validate inputs
        //the new password must be not null, different from old password
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed|different:old_password',
        ], ['new_password.confirmed' => 'Mật khẩu mới không trùng khớp']);
        $user = \Auth::user(); //get the current logged-in user
        if (\Hash::check($request->get('old_password'), $user->password)) { //check if old password is match with hashed password
            $user->password = \Hash::make($request->get('new_password')); //update new password
            $user->save(); //save info
            \Session::flash('message', 'Đã đổi mật khẩu!');
        } else {
            return back()->withErrors('Sai mật khẩu cũ')->withInput();
        }
        if (Auth::user()->has_role('admin') || Auth::user()->has_role('mod'))
            return redirect(route('password.edit.admin'));
        else
            return redirect(route('password.edit'));
    }

}
