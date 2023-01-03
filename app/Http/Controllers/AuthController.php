<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;

use Auth;

use App\Models\User;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'max:50', 'min:3'],
            'username' => ['required', 'max:20', 'min:5', 'unique:users,username'],
            'password' => ['required'],
            'email' => ['required','email','unique:users,email'],
            'no_hp' => ['required', 'numeric'],
            'gender' => ['required'],
            'nik' => ['required' ,'numeric'],
        ]);

        if ($validator->fails()) {
            return redirect('/register')
                        ->withErrors($validator)
                        ->withInput();
        }


        $users = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'gender' => $request->gender,
            'nik' => $request->nik,
            'role' => 'user'
        ]);

        if(!$users){
            return redirect('/register')->withErrors('register failed');
        }

        return redirect('/login')->with(['success' => 'Registration Success']);


    }

    public function login(){
        if(Auth::check()){
            if(auth()->user()->role == "user"){
                return redirect('/home/transaction');
            }
            return redirect('/home');
        }

        return view('auth.login');
    }

    public function login_post(Request $request){


        if(!Auth::attempt(['username' => $request->username, 'password' => $request->password])){
            return redirect('/login')->withErrors(['errors' => 'username or password is incorrect']);
        }

        if(Auth()->user()->role == "admin" || Auth()->user()->role == "kordinator"){
            return redirect('/home');
        }

        return redirect('/');

    }

    public function logout(){
        Auth::logout();

        // request()->session()->invalidate();

        // request()->session()->regenerateToken();

        return redirect('/login')->with(['success' => 'success logout']);;
    }
}
