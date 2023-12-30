<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index(){
      $admin = Auth::guard('admin')->user();
        // echo  'Welcome to Home page <b>' . strtoupper( $admin->name) . '</b> <a href="'.route('admin.logout').'">Logout</a>';
        return view('admin.dashboard')->with('admin', $admin);
    }

    public function logout(){
        $request->session()->flush();
        Auth::guard('admin')->logout();
        $request->session()->regenerate();
        return redirect()->route('admin.login');
    }
}
