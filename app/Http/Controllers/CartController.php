<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth()->user()->id;

        $all = Cart::where('user_id',$user)->get();

        $total = 0;
        $quan = 0;
        $harga = 0;

        foreach ($all as $m=>$value){

            $quan +=$value['qty'];

            $harga +=$value['total'];

            $total = $harga * $quan;
        }

        // dd($all);

        $cart = Cart::where('user_id',$user)->count();


        // dd($all);

        return view('cart',compact('all','cart','total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

        $price = Product::find($id)->price;



        // dd($price);

        $qty = 1;

        $user = Auth()->user()->id;

        $cart = Cart::where('product_id',$id)->where('user_id',$user)->first();

        // dd($cart);

        if($cart != null){

            $tset = Cart::where('product_id',$id)
            ->update([
                'qty' => $cart->qty+1,
                'total' => $cart->total+$price
            ]);

            // dd($tset);

            return redirect('/cart');
        }



        $cek = Cart::create([
            'qty' => 1,
            'no_invoice' => "INV".date('dmy').date('his').$user,
            'subtotal' => 0,
            'total' => $price,
            'user_id' => $user,
            'product_id' => $id

        ]);

        // dd($cek);

        return redirect('/cart');


    }


    public function plusqty($id){

        $user = Auth()->user()->id;

        $cart = Cart::where('id',$id)->where('user_id',$user)->first();


        // dd($cart->qty);

        $tset = Cart::where('id',$id)
            ->update([
                'qty' => $cart->qty+1,
            ]);

            // dd($tset);

            // dd($tset);

            return redirect('/cart');

    }

    public function minqty($id){

        $user = Auth()->user()->id;

        $cart = Cart::where('id',$id)->where('user_id',$user)->first();

        // dd($cart->qty);

        if($cart->qty == 1){

            Cart::where('id',$id)
            ->update([
                'qty' => 1,
            ]);

            // Cart::destroy($id);

            return redirect('/cart');

        }

        $tset = Cart::where('id',$id)
            ->update([
                'qty' => $cart->qty-1,
            ]);



            return redirect('/cart');

    }

    public function destroy($id){

        Cart::destroy($id);

        return redirect('/cart');

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
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }
}
