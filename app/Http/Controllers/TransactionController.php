<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Product;
use App\Models\Cart;
use App\Models\User;
use App\Models\PaymentTransaction;
use Illuminate\Http\Request;

use App\Mail\MailSend;
use Illuminate\Support\Facades\Mail;

use App\Models\Shipping;

use Validator;


class TransactionController extends Controller
{

    public function kurir(Request $request){
        $id = Auth()->user()->id;

        $string = $request->layanan;
        $result = preg_replace("/[^0-9]/", "", $string);


        $pri = (int)$request->total;
        $k = (int)$result;

        $rem = $pri + $k;

        $cart = Cart::where('user_id',$id)->get();

        $order = Transaction::create([
            'branch' => 'TGR',
            'status' => 'unpaid',
            'qty' => $request->totalqty,
            'total' => $rem,
            'data' => $cart,
            'user_id' => $id,
        ]);

        // dd($request->layanan);

        // dd($order);

        $a = substr($request->layanan,0,-5);


            // $r = (int)$a;
            // dd($r)

            if($a == "OKE" || $a == "REG" || $a == "ONS" || $a == "ECO" || $a == "CTC"){
                $a = substr($request->layanan,0,-5);


                // $r = (int)$a;
                // dd($b);
            }

            // dd($a);
            // dd($request->address);

            $shipping = Shipping::create([
                "alamat" => $request->address,
                "provinsi" => $request->provinsi,
                "no_rumah" => $request->no_rumah,
                "kota" => $request->kota,
                "kecamatan" => $request->kecamatan,
                "kelurahan" => $request->kelurahan,
                "kode_pos" => $request->kode_pos,
                "no_hp" => $request->no_hp,
                "jasa_expedisi" => $request->kurir,
                "layanan_ekspedisi" => $a,
                "harga_layanan" => $result,
                "transaction_id" => $order->id
            ]);

            // dd($shipping);

            foreach($cart as $car){
                $a[] = json_encode($car->product_id);

                $m = [$car->qty];

                foreach($a as $ko){
                    $j[] = Product::find(json_decode($ko))->stock;
                    $s[] = Product::find(json_decode($ko))->update([
                        'stock' => $j[0] - $m[0]
                    ]);
                }
            }



        $caro = Cart::where('user_id',$id)->get();

        $caro->each->delete();


        // dd($caro->destroy());



        return redirect('/home/transaction');

    }
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

        // $a = [];

        foreach($cart as $car){
            $a[] = json_encode($car->product_id);

            $m = [$car->qty];

            foreach($a as $ko){
                $j[] = Product::find(json_decode($ko))->stock;
                $s[] = Product::find(json_decode($ko))->update([
                    'stock' => $j[0] - $m[0]
                ]);
            }
        }

        // dd($s);


        $caro = Cart::where('user_id',$id)->get();

        $caro->each->delete();
        // dd($caro->destroy());



        // $product = Product::where('');



        return redirect('/home/transaction');

    }

    public function search(Request $request)
    {

        $search = $request->search;

        $all = Transaction::where('no_invoice','like','%'.$search.'%')->paginate(10);


        return view('dashboard.transaction',compact('all'));


    }


    public function transactionpayment(Request $request)
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


        $payment = PaymentTransaction::create([
            'nama_pengirim' => $request->nama_pengirim,
            'no_rek' => $request->no_rek,
            'bukti_image' => $nama_file,
            'nama_bank' => $request->nama_bank,
            'transaction_id' => $request->id
        ]);

        if(!$payment){
            return redirect()->back()->withErrors('payment failed');
        }

        $trans = Transaction::where('id',$request->id)
        ->update([
            'status' => 'validation'
        ]);

        $tr = Transaction::find($request->id);

        // dd($product);

        $details = [
            'judul' => 'transaction masuk',
            'status' => 'validation',
            'no_invoice' => $tr->no_invoice,
            'desc' => 'tolong validasi transaksi ini'
        ];

        $a = Transaction::where('id',$request->id)->first()->user_id;
        $b = User::where('id',$a)->first()->email;
        // dd($b);

        $as = User::orWhere('role','admin')->orWhere('role','kordinator')->get('email');
        // dd($as[1]);
        // $k = [];
        foreach($as as $value){

            $k[] = $value->email;
            // dd($k);



        }

        $k = json_encode($k);
        // dd($k);

        foreach(json_decode($k) as $l){
            // dd($k);
            $g = Mail::to($l)->send(new MailSend($details));
            // dd($g);

        }


        // Mail::to($mails)->send(new MailSend($details));





        if(!$trans){
            return redirect()->back()->withErrors('payment failed');
        }

        return redirect()->back()->with(['success' => 'payment Success']);


        // return view('dashboard.transaction',compact('all'));


    }


    public function accept($id)
    {

        $user = Auth()->user()->name;


        $a = Transaction::where('id',$id)->first()->user_id;
        $b = User::where('id',$a)->first()->email;
        // dd($b);

        $trans = Transaction::where('id',$id)
        ->update([
            'status' => 'payment successful'
        ]);

        $tr = Transaction::find($id);

        $details = [
            'judul' => 'transaction is successfuly',
            'status' => 'payment succesfuly',
            'no_invoice' => $tr->no_invoice,
            'desc' => 'transaction divalidasi oleh '.$user
        ];

        // $mails = Auth()->user()->email;

        $as = User::orWhere('role','admin')->orWhere('role','kordinator')->get('email');
        // dd($as[1]);
        // $k = [];
        foreach($as as $value){

            $k[] = $value->email;
            // dd($k);



        }

        $k = json_encode($k);
        // dd($k);

        foreach(json_decode($k) as $l){
            // dd($k);
            $g = Mail::to($l)->send(new MailSend($details));
            // dd($g);

        }



        $details = [
            'judul' => 'transaction is successfuly',
            'status' => 'payment succesfuly',
            'no_invoice' => $tr->no_invoice,
            'desc' => 'pembayaran telah di validasi'
        ];

        Mail::to($b)->send(new MailSend($details));



        return redirect()->back();
    }

    public function reject($id)
    {

        $user = Auth()->user()->name;


        $a = Transaction::where('id',$id)->first()->user_id;
        $b = User::where('id',$a)->first()->email;

        $cart = Transaction::find($id)->data;
        // dd(json_encode($cart));
        $a = [];

        foreach(json_decode($cart) as $car){
            $a[] = json_encode($car->product_id);

            $m = [$car->qty];

            foreach($a as $ko){
                $j[] = Product::find(json_decode($ko))->stock;
                $s[] = Product::find(json_decode($ko))->update([
                    'stock' => $j[0] + $m[0]
                ]);
            }
        }


        $trans = Transaction::where('id',$id)
        ->update([
            'status' => 'reject'
        ]);



        $tr = Transaction::find($id);

        $details = [
            'judul' => 'transaction is reject',
            'status' => 'reject',
            'no_invoice' => $tr->no_invoice,
            'desc' => 'transaction di reject oleh '.$user
        ];

        // $mails = Auth()->user()->email;

        $as = User::orWhere('role','admin')->orWhere('role','kordinator')->get('email');
        // dd($as[1]);
        // $k = [];
        foreach($as as $value){

            $k[] = $value->email;
            // dd($k);



        }

        $k = json_encode($k);
        // dd($k);

        foreach(json_decode($k) as $l){
            // dd($k);
            $g = Mail::to($l)->send(new MailSend($details));
            // dd($g);

        }

        $details = [
            'judul' => 'transaction is reject',
            'status' => 'reject',
            'no_invoice' => $tr->no_invoice,
            'desc' => 'transaction di reject oleh '.$user
        ];

        Mail::to($b)->send(new MailSend($details));

        return redirect()->back();
    }

    public function cancel($id)
    {

        $cart = Transaction::find($id)->data;
        // dd(json_decode($cart));

        foreach(json_decode($cart) as $car){
            $a[] = json_encode($car->product_id);

            $m = [$car->qty];

            foreach($a as $ko){
                $j[] = Product::find(json_decode($ko))->stock;
                $s[] = Product::find(json_decode($ko))->update([
                    'stock' => $j[0] + $m[0]
                ]);
            }
        }

        $trans = Transaction::where('id',$id)
                ->update([
                    'status' => 'cancel'
                ]);

                // dd($trans);

        return redirect()->back();
    }

    public function upresi(Request $request)
    {

        $ship = Shipping::where('transaction_id',$request->id)
            ->update([
                'no_resi' => $request->no_resi
            ]);


            return redirect()->back();

    }
}
