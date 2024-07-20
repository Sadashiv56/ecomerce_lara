<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class AdminController extends Controller
{
    public function login_form()
    {
        return view('admin.login-form');
    }
    public function login_functionality(Request $request)
    {
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('adminHome');
        }else{
            Session::flash('error-message','Invalid Email or Password');
            return back();
        }
    }
    public function adminHome()
    {
        return view('admin.home');
    }
    public function adminlogout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('login.form');
    }
}
