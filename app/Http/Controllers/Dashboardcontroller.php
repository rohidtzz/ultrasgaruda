<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Transaction;

use DataTables;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = User::all()->count();
        $product = Product::all()->count();


        return view('dashboard.index',compact('user','product'));
    }

    public function product()
    {

        $all = Product::all();

        // dd($all);

        return view('dashboard.product',compact('all'));
    }

    public function transactionside()
    {

        $id = Auth()->user()->id;

        $all = Transaction::all();


        return DataTables::of($all)->make(true);

        // return view('dashboard.transaction',compact('all'));
    }

    public function transaction()
    {

        $id = Auth()->user()->id;

        $all = Transaction::all();


        // return DataTables::of($all)->make(true);

         return view('dashboard.transaction',compact('all'));

        // return view('dashboard.transaction');
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
