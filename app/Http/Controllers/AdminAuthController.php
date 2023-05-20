<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Validato;
use Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function getLogin(){
        return view('admin.auth.login');
    }

    public function postLogin(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)){
            return redirect()->route('admin_dashboard')->with('success','You are Login successfully!!');
        } else {
            return back()->with('error','your username and password are wrong.');
        }
    }

    public function logout()
    {
        auth()->guard('admin')->logout();
        return redirect()->route('adminLogout')->with('success','You loged out successfully!!');
    }
}
