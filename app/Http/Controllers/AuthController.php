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
            'gender' => ['required']
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

        return redirect('/');

    }

    public function logout(){
        Auth::logout();

        // request()->session()->invalidate();

        // request()->session()->regenerateToken();

        return redirect('/login')->with(['success' => 'success logout']);;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
