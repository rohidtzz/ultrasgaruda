<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Validator;

// use Yajra\Datatables\Facades\Datatables;

use DataTables;


class UsersController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth()->user()->role == "admin"){
            $all = User::paginate(10);
        }

        if(Auth()->user()->role == "kordinator"){
            $all = User::where('role','user')->paginate(10);
        }

        // $all = User::where('role','kordinator')->orWhere('role','user')->paginate(10);

        return view('dashboard.users',compact('all'));
    }

    public function list()
    {
        return DataTables::of(User::all())->make(true);
    }

    public function search(Request $request)
    {
        $search = $request->search;

        $all = User::where('name','like','%'.$search.'%')->paginate(10);


        return view('dashboard.users',compact('all'));
    }

    public function edit(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'username' => ['required'],
            'email' => ['required'],
            'no_hp' => ['required'],
            'gender' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        // dd($validator);

        if($request->password){
            $user = User::where('id',$request->id)
                ->update([
                    'name' => $request->name,
                    'username' => $request->username,
                    'password' => bcrypt($request->password),
                    'email' => $request->email,
                    'no_hp' => $request->no_hp,
                    'gender' => $request->gender,
                    'role' => $request->role
            ]);


            if(!$user){
                return redirect()->back()->withErrors('Edit failed');
            }

            return redirect()->back()->with(['success' => 'Edit Success']);

        }


        $user = User::where('id',$request->id)
                ->update([
                    'name' => $request->name,
                    'username' => $request->username,
                    'email' => $request->email,
                    'no_hp' => $request->no_hp,
                    'gender' => $request->gender,
                    'role' => $request->role
            ]);

        // dd($product);



        if(!$user){
            return redirect()->back()->withErrors('Edit failed');
        }

        return redirect()->back()->with(['success' => 'Edit Success']);

    }

    public function delete($id)
    {
        User::destroy($id);


        return redirect()->back();

    }

}
