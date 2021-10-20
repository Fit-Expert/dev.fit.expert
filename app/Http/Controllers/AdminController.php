<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
        if(!auth()->guard('admin')->user())
        {
            return redirect(route('adminLogin'));
        }
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function calendar()
    {
         return view('admin.calendar');
    }
}

?>