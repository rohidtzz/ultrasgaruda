<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

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
        $totalqty = 0;
        $qtyto = 0;

        // dd($all);




        foreach ($all as $m=>$value){

            // $quan +=$value['qty'];

            $harga +=$value['subtotal'];


            $total = $harga;



        }

        foreach ($all as $m=>$value){

            // $quan +=$value['qty'];

            $qtyto +=$value['qty'];


            $totalqty = $qtyto;

        }


        $cart = Cart::where('user_id',$user)->count();



        // $provinsi = $this->get_province();
        // dd($all);

        return view('welcome.cart',compact('all','cart','total','totalqty'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $price = Product::find($request->id)->price;


        $produ = Product::find(1);

        if($produ->stock == 0){
            return redirect('/');
        }

        // dd($price);

        $qty = 1;

        $user = Auth()->user()->id;

        $cart = Cart::where('product_id',$request->id)->where('user_id',$user)->first();

        if($cart){
            return redirect('/cart')->withSuccess('Add Product hanya bisa 1');
        }

        $cek = Cart::create([
            'qty' => 1,
            'subtotal' => $price,
            'user_id' => $user,
            'product_id' => $request->id

        ]);

        return redirect('/cart');

        // dd($cart->size);


        // if($cart != null){



        //     if($cart->size == $request->sizes){

        //         $tset = Cart::where('product_id',$request->id)
        //         ->update([
        //             'qty' => $cart->qty+1,
        //             'total' => $cart->total,
        //             'size' => $cart->size.','.$request->sizes
        //         ]);


        //         return redirect('/cart');
        //     }



        //     $ce = Cart::create([
        //         'qty' => 1,
        //         'no_invoice' => "INV".date('dmy').date('his').$user,
        //         'subtotal' => 0,
        //         'size' => $request->sizes,
        //         'total' => $price,
        //         'user_id' => $user,
        //         'product_id' => $request->id

        //     ]);

        //     return redirect('/cart');
        // }

        // if($request->sizes == 'XXL'){

        //     $ce = Cart::create([
        //         'qty' => 1,
        //         'no_invoice' => "INV".date('dmy').date('his').$user,
        //         'subtotal' => 0,
        //         'size' => $request->sizes,
        //         'total' => $price+15000,
        //         'user_id' => $user,
        //         'product_id' => $request->id

        //     ]);

        //     return redirect('/cart');
        // }

        // $cek = Cart::create([
        //     'qty' => 1,
        //     'no_invoice' => "INV".date('dmy').date('his').$user,
        //     'subtotal' => 0,
        //     'size' => $request->sizes,
        //     'total' => $price,
        //     'user_id' => $user,
        //     'product_id' => $request->id

        // ]);

        // return redirect('/cart');

    }


    public function plusqty($id){

        $user = Auth()->user()->id;

        $cart = Cart::where('id',$id)->where('user_id',$user)->first();

        $pro = Product::find($cart->product_id);

        if($cart->size == 'XXL'){
            $tset = Cart::where('id',$id)
            ->update([
                'qty' => $cart->qty+1,
                'total' => $cart->total+$pro->price+15000,
            ]);

            return redirect('/cart');
        }

        $tset = Cart::where('id',$id)
            ->update([
                'qty' => $cart->qty+1,
                'total' => $cart->total+$pro->price,
                'size' => $cart->size
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
                'total' => $cart->total-$pro->price-15000,
            ]);
            return redirect('/cart');
        }

        $tset = Cart::where('id',$id)
            ->update([
                'qty' => $cart->qty-1,
                'total' => $cart->total-$pro->price,
                'size' => $cart->size

            ]);



            return redirect('/cart');

    }

    public function destroy($id){

        Cart::destroy($id);

        return redirect('/cart');

    }

    public function get_ongkir($origin, $destination, $weight, $courier){
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "origin=$origin&destination=$destination&weight=$weight&courier=$courier",
        CURLOPT_HTTPHEADER => array(
        "content-type: application/x-www-form-urlencoded",
        "key: 1d0baea46ae6872a997da365cbfb4046"
        ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);


        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response=json_decode($response,true);
            $data_ongkir = $response['rajaongkir']['results'];
            return json_encode($data_ongkir);
        }

        // if ($err) {
        // echo "cURL Error #:" . $err;
        // } else {
        // echo $response;
        // }

    }

    public function get_province(){

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: 1d0baea46ae6872a997da365cbfb4046"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
            } else {
            //ini kita decode data nya terlebih dahulu
            $response=json_decode($response,true);
            //ini untuk mengambil data provinsi yang ada di dalam rajaongkir resul
            $data_pengirim = $response['rajaongkir']['results'];
            return $data_pengirim;
            }

    }
    public function get_city($id){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/city?&province=$id",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: 1d0baea46ae6872a997da365cbfb4046"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
            } else {
            $response=json_decode($response,true);
            $data_kota = $response['rajaongkir']['results'];
            return json_encode($data_kota);
            }
    }

}
