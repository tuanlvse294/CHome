<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//user's editing profile controller
class ProfileController extends Controller
{
    //show all user's info
    public function edit_info(Request $request)
    {
        \Auth::user()->fill_olds();
        return view('profile.info');
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

        return redirect('/profile/info');
    }

    //change password page
    public function edit_password(Request $request)
    {
        return view('profile.password');
    }

    //save new password
    public function save_password(Request $request)
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
        return redirect('/profile/password');
    }

}
