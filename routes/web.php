<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\CartController;

use App\Http\Controllers\ProductController;

use App\Http\Controllers\DashboardController;

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

    //cart
    Route::get('/cart', [CartController::class,'index']);
    Route::post('/cart/add/', [CartController::class,'create']);
    Route::get('/cart/qty/up/{id}', [CartController::class,'plusqty']);
    Route::get('/cart/qty/min/{id}', [CartController::class,'minqty']);
    Route::get('/cart/destroy/{id}', [CartController::class,'destroy']);

});

Route::group(['middleware' => ['role:admin,kordinator']], function () {

    //dashboard
    Route::get('/home', [DashboardController::class,'index'])->name('kordinator');
    Route::get('/home/product', [DashboardController::class,'product']);

    //product home
    Route::post('/home/product/create/', [ProductController::class,'create']);

    //cart
    Route::get('/cart', [CartController::class,'index']);
    Route::post('/cart/add/', [CartController::class,'create']);
    Route::get('/cart/qty/up/{id}', [CartController::class,'plusqty']);
    Route::get('/cart/qty/min/{id}', [CartController::class,'minqty']);
    Route::get('/cart/destroy/{id}', [CartController::class,'destroy']);


});

Route::group(['middleware' => ['role:admin,kordinator,user']], function () {

    //dashboard
    Route::get('/home', [DashboardController::class,'index'])->name('kordinator');
    Route::get('/home/product', [DashboardController::class,'product']);

    //cart
    Route::get('/cart', [CartController::class,'index']);
    Route::post('/cart/add/', [CartController::class,'create']);
    Route::get('/cart/qty/up/{id}', [CartController::class,'plusqty']);
    Route::get('/cart/qty/min/{id}', [CartController::class,'minqty']);
    Route::get('/cart/destroy/{id}', [CartController::class,'destroy']);

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
