<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function login(Request $request)
    {
    	return view('login.login');
    }

    public function processLogin(Request $request)
    {
    	$request->validate([
    		'email' => 'email|required',
    		'password' => 'required'
    	]);

    	$credentials = $request->only('email', 'password');
 
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->route('ligue');
        } else {
        	return redirect()->back()->withErrors(['msg' => 'Connexion erroné']);
        }
    }

    public function logout(Request $request)
    {
    	Auth::logout();
    	return redirect()->intended('login');
    }
}
