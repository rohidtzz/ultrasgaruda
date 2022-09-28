<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\DashboardController;


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

Route::get('/', function () {
    return view('welcome');
});



route::get('/register', [AuthController::class,'index']);
route::post('/register/post', [AuthController::class,'register']);

Route::get('/login', [AuthController::class,'login']);

route::post('/login/post',[AuthController::class, 'login_post']);

Route::middleware(['role'])->group(function () {
    Route::get('/home', [DashboardController::class,'index']);
    Route::get('/cart', function () {
        return view('cart');
    });
});

Route::middleware(['role'])->group(function () {
    Route::get('/home', [DashboardController::class,'index']);
    Route::get('/cart', function () {
        return view('cart');
    });
});

Route::middleware(['role'])->group(function () {
    Route::get('/home', [DashboardController::class,'index']);
    Route::get('/cart', function () {
        return view('cart');
    });
});




Route::get('/logout', [AuthController::class,'logout']);

Route::fallback(function(){
    return reedirect('/');
});



// Route::group(['middleware' => ['role']], function () {

//     Route::get('/home', [DashboardController::class,'index']);
// });

// Route::group(['middleware' => ['role']], function () {

//     Route::get('/home', [DashboardController::class,'index']);
// });

// Route::group(['middleware' => ['role']], function () {

//     Route::get('/home', [DashboardController::class,'index']);
// });
