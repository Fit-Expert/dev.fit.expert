<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function create(Request $request)
    {
       // validate Inputs
       $request->validate([
           'name' => 'required',
           'email' => 'required|email|unique:users,email',
           'password' => 'required|min:5|max:30',
           'cpassword' => 'required|min:5|max:30|same:password'
       ]);

       $user = new User();
       $user->name = $request->name;
       $user->email = $request->email;
       $user->password = \Hash::make($request->password);

       $save = $user->save();

       if ( $save) {
        return redirect()->back()->with('success', 'You are now register successfully');
       }else{
        return redirect()->back()->with('fail', 'Something went wrong, failed to register');
       }
       
    }

    public function check(Request $request)
    {
        //validate Inputs
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:5|max:30',
        ],[
            'email.exists' => "User with this email not registered"
        ]);

        $creds = $request->only('email', 'password');

        if ( Auth::guard('web')->attempt($creds) ) {
            return redirect()->route('user.home');
        }else{
            return redirect()->route('user.login')->with('fail', 'Incorrenct credentials');
        }
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect('/');
    }
}
