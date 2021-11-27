<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use Illuminate\Support\Facades\Validator;
use Session;
use Illuminate\Support\Facades\File; 

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

    public function profile()
    {
        //echo  public_path('/admin_pics');die();
        $userid=auth()->guard('admin')->user()->id;
        $userDetails = Admin::where('id', $userid)->first();
        return view('admin.userprofile',compact('userDetails'));
    }

    public function storeprofile(Request $request)
    {
        $userid=auth()->guard('admin')->user()->id;
        $validatefields=[
            'name' => 'required',
            'phone' => 'required|digits:10',
            'email' => 'required|email'
        ];

        if ($request->hasFile('user_pic'))
        {
            $validatefields['user_pic']='required|image|mimes:jpeg,png,jpg|max:2048';
        }
        $validator = Validator::make($request->all(), $validatefields);

        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }
       
        if($request->input('password')!="" &&  $request->input('ConfirmPassword')!="")
        {
            if($request->input('password')!= $request->input('ConfirmPassword'))
            {
                return back()->withErrors('Password does not match')->withInput();
            }
        }

        $updatearr=[
            'name' => $request->name,
            'phone'=>$request->phone,
            'email'=>$request->email
        ];

        if($request->input('password')!="" &&  $request->input('ConfirmPassword')!="")
        {
            $updatearr['password']=Hash::make($request->password);
        }

        if ($request->hasFile('user_pic')) 
        {
           
            $userDetails = Admin::where('id', $userid)->first();

            if($userDetails->user_pic!=""){
                $existfilepath=public_path('/admin_pics')."/".$userDetails->user_pic;
                File::delete($existfilepath);
            }
            
            $image = $request->file('user_pic');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/admin_pics');
            $image->move($destinationPath, $name); 
            $updatearr['user_pic']=$name;
        }

       
        Admin::where('id', $userid)->update($updatearr);
        return redirect()->back()->with('profilesuccess', 'Your profile is successfully updated');
    }
}

?>