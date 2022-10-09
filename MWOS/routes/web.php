<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\AdminController;
use App\http\Controllers\UserController;
use App\http\Controllers\CarpenterController;
use App\http\Controllers\mangeUsersController;
use Illuminate\Support\Facades\Auth;

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
Route::get('/login', function () {
    return view('login');
});



// PRODUCTS CATEGORY ROUTE - LEANDRY
Route::get('/productCategory', function () {
    return view('productCategory');
});

// MATERIAL CATEGORY ROUTE - LEANDRY
Route::get('/materialCategory', function () {
    return view('materialCategory');
});




//prevent Back to login after registration
Route::middleware(['middleware' => 'PreventBack'])->group(function () {
    Auth::routes();
});
//Routes for Admin
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
route::group(['prefix' => 'admin', 'middleware' => ['isAdmin', 'auth', 'PreventBack']], function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('mangeUsers', [mangeUsersController::class, 'index'])->name('admin.mangeUsers');
    Route::get('mangeUsersSearch', [mangeUsersController::class, 'index'])->name('admin.usersSearch');
    // Route::get('profile', [AdminController::class, 'profile'])->name('admin.profile');

});
//Routes for Carpenter

route::group(['prefix' => 'carpenter', 'middleware' => ['isCarpenter', 'auth', 'PreventBack']], function () {
    Route::get('dashboard', [CarpenterController::class, 'dashboard'])->name('carpenter.dashboard');
    // Route::get('profile', [CarpenterController::class, 'profile'])->name('carpenter.profile');

});

//Routes for Users(Customers)
route::group(['prefix' => 'user', 'middleware' => ['isUser', 'auth', 'PreventBack']], function () {
    Route::get('dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    // Route::get('profile', [UserController::class, 'profile'])->name('user.profile');
});
//Routes for All System Users 
route::group(['prefix' => 'allUsers','middleware' => ['auth', 'PreventBack']], function () {
    Route::get('profile', [UserController::class, 'profile'])->name('allUsers.profile');
    Route::post('update-profile', [UserController::class, 'profileUpdate'])->name('update.profile');

});
