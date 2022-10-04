<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Product;
use App\Models\Cart;
use App\Models\DetailTransaction;
use Illuminate\Http\Request;

use Validator;


class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $id = Auth()->user()->id;

        // $s = Transaction::where('user_id',$id)->get();
        // $k = $s->product_id;



        $cart = Cart::where('user_id',$id)->get();

        // dd($cart);

        //  foreach($cart as $b=>$value){
        //             //  $k = $value;
        //              $k = $value;
        // }

            // $data = [
            //     'size' => $m,
            //     'qty'=> $m,
            //     'price' => $m,
            //     'product' => $m
            // ];

        //     dd($carti);

        // $h = $m;

        // $s = json_encode(["XL","S"]);

        // dd($s);


        // foreach($s as $as=>$value){
        //     $m = $value;
        // }

        // $l = json_decode($s);

        // dd($l);

        // foreach($l as $b=>$value){
        //          $k = Product::find($l);
        // }

        // $p = Transaction::where('user_id',$id)->get();


        // foreach($p as $b=>$value){
        //              $k = $value;
        //     }

        // $o = json_decode($k->product_id);


        // foreach($o as $j=>$value){
        //     $n = $k = Product::find($o);
        // }

        // dd($n);

        // $data = [
        //     'data' => $cart,
        // ];

        // $dataa = json_encode($cart);

        // $dataa = json_encode($cart);

        // foreach($cart as $as=>$value){
        //     // $cart = $value;
        //     foreach($cart as $a){
        //         $s = $a->qty;
        //     }
        // }



        $order = Transaction::create([
            'branch' => 'TGR',
            'status' => 'unpaid',
            'qty' => $request->totalqty,
            'total' => $request->total,
            'data' => $cart,
            'user_id' => $id,
        ]);



        $caro = Cart::where('user_id',$id)->get();

        $caro->each->delete();
        // dd($caro->destroy());



        return redirect('/home/transaction');

    }

    public function search(Request $request)
    {

        $search = $request->search;

        $all = Transaction::where('no_invoice','like','%'.$search.'%')->paginate(10);


        return view('dashboard.transaction',compact('all'));


    }


    public function transactiondetail(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'nama_pengirim' => ['required'],
            'nama_bank' => ['required'],
            'no_rek' => ['required'],
        ]);

        // dd($validator);

        if($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }


        $this->validate($request, [
			'bukti_image' => 'required|file|image|mimes:jpeg,png,jpg|max:2048'
		]);

        $file = $request->file('bukti_image');
		$nama_file = $file->getClientOriginalName();
		$tujuan_upload = 'trans/img';
		$file->move($tujuan_upload,$nama_file);


        $product = Transaction::where('id',$request->id)
        ->update([
            'nama_pengirim' => $request->nama_pengirim,
            'no_rek' => $request->no_rek,
            'bukti_image' => $nama_file,
            'nama_bank' => $request->nama_bank,
            'status' => 'validation'
        ]);

        // dd($product);





        if(!$product){
            return redirect()->back()->withErrors('register failed');
        }

        return redirect()->back()->with(['success' => 'Registration Success']);


        // return view('dashboard.transaction',compact('all'));


    }


    public function accept($id)
    {

        $trans = Transaction::where('id',$id)
                ->update([
                    'status' => 'payment successful'
                ]);




        return redirect()->back();
    }

    public function reject($id)
    {

        $trans = Transaction::where('id',$id)
        ->update([
            'status' => 'reject'
        ]);

        return redirect()->back();
    }

    public function cancel($id)
    {
        $trans = Transaction::where('id',$id)
                ->update([
                    'status' => 'cancel'
                ]);

                // dd($trans);

        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
