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

        // dd($all);




        foreach ($all as $m=>$value){

            // $quan +=$value['qty'];

            $harga +=$value['total'];


            $total = $harga;



        }



            // foreach ($all as $m=>$value){

            //     $quan +=$value['qty'];


            //     $harga +=$value['total'];


            //     $total = $harga * $quan;
            // }




        // dd($all);

        $cart = Cart::where('user_id',$user)->count();


        // dd($all);

        return view('welcome.cart',compact('all','cart','total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $price = Product::find($request->id)->price;



        // dd($price);

        $qty = 1;

        $user = Auth()->user()->id;

        $cart = Cart::where('product_id',$request->id)->where('user_id',$user)->first();

        // dd($cart->size);


        if($cart != null){

            // $row = [
            //     'size' => $cart->size.','.$request->sizes
            // ];

            if($cart->size == $request->sizes){
                // $ce =Cart::where('product_id',$request->id)
                // ->update([
                //     'qty' => $cart->qty+1,
                //     'total' => $cart->total+$price,
                //     'size' => $cart->size,
                // ]);
                $tset = Cart::where('product_id',$request->id)
                ->update([
                    'qty' => $cart->qty+1,
                    'total' => $cart->total,
                    'size' => $cart->size.','.$request->sizes
                ]);



                // dd($cek);

                return redirect('/cart');
            }



            $ce = Cart::create([
                'qty' => 1,
                'no_invoice' => "INV".date('dmy').date('his').$user,
                'subtotal' => 0,
                'size' => $request->sizes,
                'total' => $price,
                'user_id' => $user,
                'product_id' => $request->id

            ]);








            // dd($tset);

            return redirect('/cart');
        }

        if($request->sizes == 'XXL'){

            $ce = Cart::create([
                'qty' => 1,
                'no_invoice' => "INV".date('dmy').date('his').$user,
                'subtotal' => 0,
                'size' => $request->sizes,
                'total' => $price+5000,
                'user_id' => $user,
                'product_id' => $request->id

            ]);

            return redirect('/cart');
        }

        $cek = Cart::create([
            'qty' => 1,
            'no_invoice' => "INV".date('dmy').date('his').$user,
            'subtotal' => 0,
            'size' => $request->sizes,
            'total' => $price,
            'user_id' => $user,
            'product_id' => $request->id

        ]);

        return redirect('/cart');









        // if($cart->size == $request->sizes){

        // }

        // $cor = ['size' => $request->sizes];



        // dd($cek);




    }


    public function plusqty($id){

        $user = Auth()->user()->id;

        $cart = Cart::where('id',$id)->where('user_id',$user)->first();

        $pro = Product::find($cart->product_id);

        if($cart->size == 'XXL'){
            $tset = Cart::where('id',$id)
            ->update([
                'qty' => $cart->qty+1,
                'total' => $cart->total+$pro->price+5000,
            ]);

            return redirect('/cart');
        }

        $tset = Cart::where('id',$id)
            ->update([
                'qty' => $cart->qty+1,
                'total' => $cart->total+$pro->price,
            ]);

            return redirect('/cart');

    }

    public function minqty($id){

        $user = Auth()->user()->id;

        $cart = Cart::where('id',$id)->where('user_id',$user)->first();

        $pro = Product::find($cart->product_id);


        if($cart->qty == 1){

            Cart::where('id',$id)
            ->update([
                'qty' => 1,
            ]);

            return redirect('/cart');
        }

        if($cart->size == 'XXL'){
            $tset = Cart::where('id',$id)
            ->update([
                'qty' => $cart->qty-1,
                'total' => $cart->total-$pro->price-5000,
            ]);
            return redirect('/cart');
        }

        $tset = Cart::where('id',$id)
            ->update([
                'qty' => $cart->qty-1,
                'total' => $cart->total-$pro->price,
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
