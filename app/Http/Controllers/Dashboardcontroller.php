<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Transaction;
use App\Models\PaymentTransaction;

use DataTables;

use Carbon\Carbon;

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
        // $dat = date('Y-m-d');

        $user = User::all()->count();
        $product = Product::all()->count();
        $sales = Transaction::where('status','payment successful')->orWhere('status','success')->get();
        $here = Transaction::whereDate('created_at', Carbon::today() )->where('status','payment successful')->orWhere('status','success')->get();
        if($here){

            $c = 0;
            foreach($here as $am){

            $c += $am->total;
            }


            $here = $c;

        } else {

            $here = 0;
        }

        if($sales){

            $a = 0;
            foreach($sales as $ak){

                $a += $ak->total;
            }

            $sales = $a;


            return view('dashboard.index',compact('user','product','sales','here'));

        }

        $sales = 0;



        return view('dashboard.index',compact('user','product','sales','here'));
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



        if(Auth()->user()->role == "admin"){
            $all = Transaction::orderBy('created_at',"desc")->paginate(10);
        }elseif(Auth()->user()->role == "kordinator"){
            $all = Transaction::orderBy('created_at',"desc")->paginate(10);
        }elseif(Auth()->user()->role == "user"){
            $all = Transaction::where('user_id',$id)->orderBy('created_at',"desc")->paginate(10);
        }


        // return DataTables::of($all)->make(true);

         return view('dashboard.transaction',compact('all'));

        // return view('dashboard.transaction');
    }

}
