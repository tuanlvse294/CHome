<?php

namespace App\Http\Controllers;

use App\Notification;
use App\User;
use Illuminate\Http\Request;
use Response;

//user's editing profile controller
class UserController extends Controller
{
    public function manage()
    {
        return view('user.list', ['items' => User::all(), 'title' => 'Quản lý người dùng']);
    }

    public function trash()
    {
        return view('user.list', ['items' => User::onlyTrashed()->get(), 'title' => 'Quản lý người dùng đã xoá', 'trash' => true]);
    }

    public function delete(User $user)
    {
        \Session::flash("message", "Đã xoá tài khoản " . $user->email);
        $user->delete();
        return redirect(route('users.manage'));
    }

    public function show(User $user)
    {
        return view('offer.mine', ['items' => $user->offers, 'title' => 'Tin đăng của ' . $user->name, 'user' => $user]);
    }

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
        return view('user.notifications', ['notifications' => \Auth::user()->all_notifications()->paginate(5), 'title' => 'Tất cả thông báo']);
    }


    public function export_csv()
    {
        $headers = [
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0'
            , 'Content-type' => 'text/csv'
            , 'Content-Disposition' => 'attachment; filename=users.csv'
            , 'Expires' => '0'
            , 'Pragma' => 'public'
        ];

        $list = User::all()->toArray();

        # add headers for each column in the CSV download
        array_unshift($list, array_keys($list[0]));

        $callback = function () use ($list) {
            $FH = fopen('php://output', 'w');
            foreach ($list as $row) {
                fputcsv($FH, $row);
            }
            fclose($FH);
        };

        return Response::stream($callback, 200, $headers); //use Illuminate\Support\Facades\Response;

    }

    public function restore($user)
    {
        $user = User::withTrashed()->find($user);
        $user->restore();
        \Session::flash("message", "Khôi phục tài khoản " . $user->email);
        return redirect(route('users.manage'));
    }

    public function force_delete($user)
    {
        $user = User::withTrashed()->find($user);
        \Session::flash("message", "Đã xoá vĩnh viễn tài khoản " . $user->email);
        $user->forceDelete();
        return redirect(route('users.trash'));
    }

//show all user's info
    public
    function edit_info(Request $request)
    {
        \Auth::user()->fill_olds();
        return view('user.info');
    }

//save edited info
    public
    function save_info(Request $request)
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
        ]);
        $user = \Auth::user(); //get the current logged-in user
        if (\Hash::check($request->get('old_password'), $user->password)) { //check if old password is match with hashed password
            $user->password = \Hash::make($request->get('new_password')); //update new password
            $user->save(); //save info
            \Session::flash('message', 'Đã đổi mật khẩu!');
        } else {
            return back()->withErrors('Sai mật khẩu cũ')->withInput();
        }
        return redirect(route('password.edit'));
    }

}
