<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Validator;

use Socialite;
use App\User;
use Auth;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login( Request $request )
    {
        // echo 1;die;
        /*validation the form*/
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        /*attempt the user login */
        // Auth::guard('admin')->attempt( $credentials, $remember );
        if( Auth::guard('admin')->attempt( ['email'=>$request->email,'password'=>$request->password], $request->remember ) )
        {
            /*if success than redirect to intended location */
            return redirect()->intended( route('admin.dashboard') );
        }
        /*if unsuccessfull than*/
        return redirect()->back()->withInput( $request->only( 'email','remember' ) );
    }    
}
