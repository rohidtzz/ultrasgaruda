<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use Illuminate\Http\Request;

use File;

use Validator;

use Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $all = Category::with('product')->get();
        // dd($all);

        $all = Product::all();



        $cekauth = Auth::check();

        if(!$cekauth){
            $cart = false;
            return view('welcome.welcome',compact('all','cart'));
        }

        $id = Auth()->user()->id;

        $cart = Cart::where('user_id',$id)->count();

        // dd($cart);

        // $cart = 1;


        return view('welcome.welcome',compact('all','cart'));
    }


    public function destroyproduct($id){




        $product = Product::find($id);


        if(File::exists(public_path('product/img/'.$product->image))){
            File::delete(public_path('product/img/'.$product->image));
        }else{
            dd('File does not exists.');
        }

        Product::destroy($id);


        return redirect()->back();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        // $postData = $request->only('file');
        //     $file = $postData['file'];

        //     $fileArray = array('image' => $file);


        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'price' => ['required'],
            'stock' => ['required'],
        ]);

        // dd($validator);

        if($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }


        $this->validate($request, [
			'image' => 'required|file|image|mimes:jpeg,png,jpg|max:2048'
		]);

        $file = $request->file('image');
		$nama_file = $file->getClientOriginalName();
		$tujuan_upload = 'product/img';
		$file->move($tujuan_upload,$nama_file);


        $product = Product::create([
            'name' => $request->name,
            'image' => $nama_file,
            'price' => $request->price,
            'stock' => $request->stock,
            'size' => "S,M,L,XL,XXL",
            'category_id' => 1,
        ]);

        // dd($product);



        if(!$product){
            return redirect()->back()->withErrors('register failed');
        }

        return redirect()->back()->with(['success' => 'Registration Success']);




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
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product)
    {
        //
    }
}
