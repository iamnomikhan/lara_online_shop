<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Admin_controller extends Controller
{
   public function index(){
        return view('admin.login');
    }

    public function authenticate(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required | email',
            'password' => 'required',
        ]);

        if($validator->passes()){
            if(Auth::guard('admin')->attempt(['email'=> $request->email,
            'password'=> $request->password],$request->get('remember'))){
                $admin = Auth::guard('admin')->user();
                if($admin->role == 2){
                    unset($admin->password);
                    session(['user_data' => $admin]);
                    return redirect()->route('admin.dashboard');
                }else{
                    Auth::guard('admin')->logout();
                    return redirect()->route('admin.login')->with('error','You Are Not authorized To Access Admin Panel.');
                }

            }else{
                return redirect()->route('admin.login')->with('error','Email/Password is incorrect');
            }
        }else{
            return redirect()->route('admin.login')
            ->withErrors($validator)
            ->withInput($request->only('email'));
        }
    }

}
