<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function check(Request $request)
    {
        //validate inputs
        $request->validate([
            'email' => 'required|email|exists:admins,email',
            'password' => 'required|min:5|max:30' 
        ],[
            'email.exists' => 'User with these email not exists'
        ]) ;
        
        $creds = $request->only('email','password');

        if ( Auth::guard('admin')->attempt($creds) ) {
            return redirect()->route('admin.home');
        }else{
            return redirect()->route('admin.login')->with('fail','Incorrect credentials');
        }
    }
}
