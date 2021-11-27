<?php

namespace App\Http\Controllers\Auth;

use Validator;
use Session;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminAuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function getLogin()
    {
        if(auth()->guard('admin')->user()){

            return redirect()->route('dashboard');
        }

        return view('auth.admin.login');
    }
    

    public function getRegister()
    {
        if(auth()->guard('admin')->user()){

            return redirect()->route('dashboard');
        }

        return view('auth.admin.registration');
    }

    public function postRegister(Request $request)
    {

        $this->validate($request, [
            'usertype' => 'required',
            'name' => 'required',
            'phone' => 'required|digits:10',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($request->input('password')!= $request->input('ConfirmPassword'))
        {
            return back()->withInput($request->input())->with('error','Password does not match');
        }

        $admin = new Admin;
        $admin->usertype = $request->usertype;
        $admin->name = $request->name;
        $admin->phone = $request->phone;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->save();

       // return back()->with('success','You are Register successfully. Please login');
       \Session::put('success','You are Register successfully. Please login');
        return redirect()->route('adminLogin');
    }

    /**
     * Show the application loginprocess.
     *
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (auth()->guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')]))
        {
            $user = auth()->guard('admin')->user();
            
            \Session::put('success','You are Login successfully!!');
            return redirect()->route('dashboard');
            
        } else {
            return back()->with('error','your username and password are wrong.');
        }

    }

    /**
     * Show the application logout.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        auth()->guard('admin')->logout();
        \Session::flush();
       /// \Sessioin::put('success','You are logout successfully');        
        return redirect(route('adminLogin'));
    }
}
?>