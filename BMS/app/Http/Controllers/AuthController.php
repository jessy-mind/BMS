<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
    public function login(Request $request)
    {
        if (Auth::check() && $request->path() == 'login') {
           return redirect('/dashboard');
        } else {
            return view('login');
        }
    }
    
    public function loginData(Request $request)
    {
       if ( Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/dashboard');
       } else {
        //  return session()->flash('success', 'New super admin was saved successfully!')
         return redirect()->back();
       }
       
    }

}
