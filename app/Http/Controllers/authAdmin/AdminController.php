<?php

namespace App\Http\Controllers\authAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function loginAdmin()
    {
        return view('authAdmin.login');
    }

    public function check(Request $request)
    {

        $check  =   $request->all();
        if (Auth::guard('admin')->attempt(['email'=>$check['email'],'password'=>$check['password']])) {
            return redirect()->route('admin-dashboard');
        }else{
            return redirect()->back()->with('error', 'Your Credential is invalid');
        }

    }

    public function dashboard()
    {
        return view('admin-dashboard');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('loginAdmin')->with('msg' , 'You Are Logged Out');
    }
}
