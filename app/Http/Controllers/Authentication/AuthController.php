<?php

namespace App\Http\Controllers\Authentication;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    function index() {
        return view('authentication.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            ],[
            'email.required' => 'Email is required!',
            'password.required' => 'Password is required!',
            ]);

        $credentials = $request->only('email', 'password');
        $remember_me = $request->has('remember') ? true : false;
        if (Auth::attempt($credentials)) {
            return redirect('dashboard')->with('message', 'You are logedin Sucessfully.');
        }
        else{
            return redirect()->back()->with('error', 'You have entered invalid credentials');
        }

    }


    public function logout() {
        Session::flush();
        Auth::logout();
        return redirect('/');
    }
}
