<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Validator;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = auth()->user()->id;

        $all = User::find($id);

        return view('dashboard.profile',compact('all'));
    }

    public function edit(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'password' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }


        $user = User::where('id',$request->id)
                ->update([
                    'password' => bcrypt($request->password),
            ]);


        if(!$user){
            return redirect()->back()->withErrors('Change failed');
        }

        return redirect()->back()->with(['success' => 'Change password Success']);

    }


}
