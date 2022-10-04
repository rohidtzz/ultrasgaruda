<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\CartController;

use App\Http\Controllers\ProductController;

use App\Http\Controllers\DashboardController;

use App\Http\Controllers\TransactionController;

use App\Models\Product;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



// Route::get('/', function () {

//     $all = Product::all();


//     return view('welcome',compact('all'));
// });


route::Get('/', [ProductController::class,'index']);


route::get('/register', [AuthController::class,'index']);
route::post('/register/post', [AuthController::class,'register']);

Route::get('/login', [AuthController::class,'login']);

route::post('/login/post',[AuthController::class, 'login_post']);



Route::group(['middleware' => ['role:admin']], function () {

    //dashboard
    Route::get('/home', [DashboardController::class,'index'])->name('admin');
    Route::get('/home/product', [DashboardController::class,'product']);

    //product home
    Route::get('/home/product/delete/{id}', [ProductController::class,'destroyproduct']);
    Route::post('/home/product/create/', [ProductController::class,'create']);
    Route::post('/home/product/edit', [ProductController::class,'edit']);

    //transaction home
    Route::get('/home/transaction/side', [DashboardController::class,'transactionside']);
    Route::get('/home/transaction', [DashboardController::class,'transaction']);
    Route::post('/home/transaction/search', [TransactionController::class,'search']);

    Route::post('/home/transaction/detail/post', [TransactionController::class,'transactiondetail']);

    //reject
    Route::get('/home/transaction/reject/{id}', [TransactionController::class,'reject']);
    //accept
    Route::get('/home/transaction/accept/{id}', [TransactionController::class,'accept']);
    //cancel
    Route::get('/home/transaction/cancel/{id}', [TransactionController::class,'cancel']);


    //transaction
    Route::POST('/transaction', [TransactionController::class,'index']);

    //cart
    Route::get('/cart', [CartController::class,'index']);
    Route::post('/cart/add/', [CartController::class,'create']);
    Route::get('/cart/qty/up/{id}', [CartController::class,'plusqty']);
    Route::get('/cart/qty/min/{id}', [CartController::class,'minqty']);
    Route::get('/cart/destroy/{id}', [CartController::class,'destroy']);



    //ongkir
    Route::get('/origin={city_origin}&destination={city_destination}&weight={weight}&courier={courier}',[CartController::class, 'get_ongkir']);
    Route::get('province',[CartController::class, 'get_province'])->name('province');
    Route::get('/kota/{id}',[CartController::class, 'get_city']);

});

Route::group(['middleware' => ['role:admin,kordinator']], function () {

    //dashboard
    Route::get('/home', [DashboardController::class,'index'])->name('admin');
    Route::get('/home/product', [DashboardController::class,'product']);

    //product home
    Route::get('/home/product/delete/{id}', [ProductController::class,'destroyproduct']);
    Route::post('/home/product/create/', [ProductController::class,'create']);
    Route::post('/home/product/edit', [ProductController::class,'edit']);

    //transaction home
    Route::get('/home/transaction/side', [DashboardController::class,'transactionside']);
    Route::get('/home/transaction', [DashboardController::class,'transaction']);
    Route::post('/home/transaction/search', [TransactionController::class,'search']);

    Route::post('/home/transaction/detail/post', [TransactionController::class,'transactiondetail']);

    //reject
    Route::get('/home/transaction/reject/{id}', [TransactionController::class,'reject']);
    //accept
    Route::get('/home/transaction/accept/{id}', [TransactionController::class,'accept']);
    //cancel
    Route::get('/home/transaction/cancel/{id}', [TransactionController::class,'cancel']);


    //transaction
    Route::POST('/transaction', [TransactionController::class,'index']);

    //cart
    Route::get('/cart', [CartController::class,'index']);
    Route::post('/cart/add/', [CartController::class,'create']);
    Route::get('/cart/qty/up/{id}', [CartController::class,'plusqty']);
    Route::get('/cart/qty/min/{id}', [CartController::class,'minqty']);
    Route::get('/cart/destroy/{id}', [CartController::class,'destroy']);




    //ongkir
    Route::get('/origin={city_origin}&destination={city_destination}&weight={weight}&courier={courier}',[CartController::class, 'get_ongkir']);
    Route::get('province',[CartController::class, 'get_province'])->name('province');
    Route::get('/kota/{id}',[CartController::class, 'get_city']);



});

Route::group(['middleware' => ['role:admin,kordinator,user']], function () {

    //dashboard
    Route::get('/home', [DashboardController::class,'index'])->name('kordinator');
    // Route::get('/home/product', [DashboardController::class,'product']);

    //transaction
    Route::POST('/transaction', [TransactionController::class,'index']);

    //Transaction home
    // Route::get('/home/transaction/side', [DashboardController::class,'transactionside']);
    Route::get('/home/transaction', [DashboardController::class,'transaction']);

    //cancel
    Route::get('/home/transaction/cancel/{id}', [TransactionController::class,'cancel']);

    Route::post('/home/transaction/detail/post', [TransactionController::class,'transactiondetail']);

    //cart
    Route::get('/cart', [CartController::class,'index']);
    Route::post('/cart/add/', [CartController::class,'create']);
    Route::get('/cart/qty/up/{id}', [CartController::class,'plusqty']);
    Route::get('/cart/qty/min/{id}', [CartController::class,'minqty']);
    Route::get('/cart/destroy/{id}', [CartController::class,'destroy']);

    Route::post('/cek', [CartController::class,'cost']);

    //ongkir
    Route::get('/origin={city_origin}&destination={city_destination}&weight={weight}&courier={courier}',[CartController::class, 'get_ongkir']);
    Route::get('province',[CartController::class, 'get_province'])->name('province');
    Route::get('/kota/{id}',[CartController::class, 'get_city']);



});




Route::get('/logout', [AuthController::class,'logout'])->name('logout');

// Route::fallback(function(){
//     return redirect('/');
// });

// Route::middleware(['role:admin'])->group(function () {
//     Route::get('/home', [DashboardController::class,'index'])->name('admin');
//     Route::get('/cart', function () {
//         return view('cart');
//     });
// });

// Route::middleware(['role:kordinator'])->group(function () {
//     Route::get('/home', [DashboardController::class,'index'])->name('kordinator');
//     // Route::get('/cart', function () {
//     //     return view('cart');
//     // });
// });

// Route::middleware(['role:user'])->group(function () {
//     Route::get('/home', [DashboardController::class,'index'])->name('user');
//     Route::get('/cart', function () {
//         return view('cart');
//     });
// });
