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



Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/home', [DashboardController::class,'index'])->name('admin');
    Route::get('/cart', function () {
                return view('cart');
    });
});

Route::group(['middleware' => ['role:admin,kordinator']], function () {
    Route::get('/home', [DashboardController::class,'index'])->name('kordinator');
    Route::get('/cart', function () {
        return view('cart');
});
});

Route::group(['middleware' => ['role:admin,kordinator,user']], function () {
    Route::get('/home', [DashboardController::class,'index'])->name('kordinator');
    Route::get('/cart', function () {
        return view('cart');
});
});




Route::get('/logout', [AuthController::class,'logout'])->name('logout');

Route::fallback(function(){
    return redirect('/');
});

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
