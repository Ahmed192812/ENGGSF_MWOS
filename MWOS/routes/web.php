<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\AdminController;
use App\http\Controllers\UserController;
use App\http\Controllers\CarpenterController;
use App\http\Controllers\mangeUsersController;
use App\http\Controllers\ProductCategoryController;
use App\http\Controllers\MaterialsController;
use App\http\Controllers\ProductsController;
use App\http\Controllers\OrderController;
use App\http\Controllers\CustomController;
use App\http\Controllers\RepairController;
use App\http\Controllers\mangeOrders;


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

//prevent Back to login after registration
Route::middleware(['middleware' => 'PreventBack'])->group(function () {
    Auth::routes(['verify'=>true]);
//    Route::get('auth.login','LoginController@formLogin');
});

//Routes for Admin
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
route::group(['prefix' => 'admin', 'middleware' => ['isAdmin', 'auth', 'PreventBack']], function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('mangeUsers', [mangeUsersController::class, 'index'])->name('admin.mangeUsers');
    Route::get('mangeUsersSearch', [mangeUsersController::class, 'index'])->name('admin.usersSearch');
    Route::get('mangeUsersFilter', [mangeUsersController::class, 'index'])->name('admin.mangeUsersFilter');
    Route::post('add-update-mangeUsers', [mangeUsersController::class, 'store'])->name('admin.add-update-mangeUsers');
    Route::post('edit-mangeUsers', [mangeUsersController::class, 'edit'])->name('admin.edit-mangeUsers');
    Route::post('delete-mangeUsers', [mangeUsersController::class, 'destroy'])->name('admin.delete-mangeUsers');

    Route::get('productCategory', [ProductCategoryController::class, 'index'])->name('admin.productCategory');
    Route::get('productCategorySearch', [ProductCategoryController::class, 'index'])->name('admin.productCategorySearch');
    Route::post('add-update-productCategory', [ProductCategoryController::class, 'store'])->name('admin.add-update-productCategory');
    Route::post('edit-productCategory', [ProductCategoryController::class, 'edit'])->name('admin.edit-productCategory');
    Route::post('delete-productCategory', [ProductCategoryController::class, 'destroy'])->name('admin.delete-productCategory');
    Route::get('material', [MaterialsController::class, 'index'])->name('admin.material');
    Route::get('materialSearch', [MaterialsController::class, 'index'])->name('admin.materialSearch');
    Route::post('add-update-material', [MaterialsController::class, 'store'])->name('admin.add-update-material');
    Route::post('edit-material', [MaterialsController::class, 'edit'])->name('admin.edit-material');
    Route::post('delete-material', [MaterialsController::class, 'destroy'])->name('admin.delete-material');
    Route::get('products', [ProductsController::class, 'index'])->name('admin.products');
    Route::get('productsSearch', [ProductsController::class, 'index'])->name('admin.productsSearch');
    Route::get('productsFilter', [ProductsController::class, 'index'])->name('admin.productsFilter');
    Route::post('add-update-products', [ProductsController::class, 'store'])->name('admin.add-update-products');
    Route::post('edit-products', [ProductsController::class, 'edit'])->name('admin.edit-products');
    Route::post('delete-products', [ProductsController::class, 'destroy'])->name('admin.delete-products');
    Route::get('mangeOrders', [mangeOrders::class, 'index'])->name('admin.mangeOrders');
    Route::get('OrdersArchives', [mangeOrders::class, 'archives'])->name('admin.OrdersArchives');

    Route::post('mangeOrders-updateOrder', [mangeOrders::class, 'store'])->name('admin.mangeOrders-updateOrder');
    Route::post('edit-repairOrder', [RepairController::class, 'edit'])->name('admin.edit-repairOrder');
    Route::post('edit-customOrder', [CustomController::class, 'edit'])->name('admin.edit-customOrder');
    Route::post('edit-Orders', [OrderController::class, 'edit'])->name('admin.edit-Orders');
    Route::post('delete-repairOrder', [RepairController::class, 'destroy'])->name('admin.delete-repairOrder');
    Route::post('delete-customOrder', [CustomController::class, 'destroy'])->name('admin.delete-customOrder');
    Route::post('delete-Orders', [OrderController::class, 'destroy'])->name('admin.delete-Orders');



});

//Routes for Carpenter
route::group(['prefix' => 'carpenter', 'middleware' => ['isCarpenter', 'auth', 'PreventBack']], function () {
    Route::get('dashboard', [CarpenterController::class, 'dashboard'])->name('carpenter.dashboard');
    // Route::get('profile', [CarpenterController::class, 'profile'])->name('carpenter.profile');

});

//Routes for Users(Customers)
route::group(['prefix' => 'user', 'middleware' => ['isUser', 'auth', 'PreventBack']], function () {
    Route::get('home', [UserController::class, 'home'])->name('user.dashboard');
    Route::get('catalog', [UserController::class, 'catalog'])->name('user.catalog');
    Route::get('repair', [RepairController::class, 'index'])->name('user.repair');
    Route::get('custom', [CustomController::class, 'index'])->name('user.custom');
    Route::post('customAdd', [CustomController::class, 'store'])->name('user.customAdd');
    Route::post('repairAdd', [RepairController::class, 'store'])->name('user.repairAdd');
    Route::get('orders', [UserController::class, 'orders'])->name('user.orders');

    Route::post('edit-repairOrder', [RepairController::class, 'edit'])->name('user.edit-repairOrder');
    Route::post('edit-customOrder', [CustomController::class, 'edit'])->name('user.edit-customOrder');
    Route::post('edit-Orders', [OrderController::class, 'edit'])->name('user.edit-Orders');


    Route::get('Transaction/orderForm/{products}', [OrderController::class, 'create']);
    Route::resource('order', OrderController::class);
    Route::resource('user', UserController::class);
});

//Routes for All System Users 
route::group(['prefix' => 'allUsers','middleware' => ['auth', 'PreventBack']], function () {
    Route::get('profile', [UserController::class, 'profile'])->name('allUsers.profile');
    Route::post('update-profile', [UserController::class, 'profileUpdate'])->name('update.profile');
    Route::get('changePassword', [UserController::class, 'changePssword'])->name('allUsers.changePassword');
    Route::post('updateChangePassword', [UserController::class, 'UpdatePassword'])->name('allUsers.updateChangePassword');
    Route::get('phoneVerify', [UserController::class, 'verifyCodeView'])->name('allUsers.phoneVerify');
    Route::post('verifyCode', [UserController::class, 'verifyCode'])->name('allUsers.verifyCode');
});
