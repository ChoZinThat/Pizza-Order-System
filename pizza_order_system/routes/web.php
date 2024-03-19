<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\CustomerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// login - register
Route::middleware(['admin_auth'])->group(function () {
    Route::redirect('/', 'loginPage' );
    Route::get('loginPage',[AuthController::class, 'loginPage'])->name('auth#loginPage');
    Route::get('registerPage',[AuthController::class, 'registerPage'])->name('auth#registerPage');
});



Route::middleware(['auth'])->group(function () {

    //dashboard
    Route::get('/dashboard',[AuthController::class,'dashboard'])->name('dashboard');

    //admin
    Route::middleware(['admin_auth'])->group(function(){
        //category
        Route::prefix('category')->group(function(){
            Route::get('list',[CategoryController::class, 'list'])->name('category#list');
            Route::get('create/page',[CategoryController::class, 'createPage'])->name('category#createPage');
            Route::post('create',[CategoryController::class,'create'])->name('category#create');
            Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
            Route::get('edit/page/{id}',[Categorycontroller::class,'editPage'])->name('category#editPage');
            Route::post('update',[CategoryController::class,'update'])->name('category#update');
            });

        //admin account
        Route::prefix('admin')->group(function(){
            //password
            Route::get('password/changePage',[AdminController::class,'changePasswordPage'])->name('admin#changePasswordPage');
            Route::post('change/password',[AdminController::class,'changePassword'])->name('admin#changePassword');

            //account detail
            Route::get('details',[AdminController::class,'detail_account'])->name('admin#details');
            Route::get('edit',[AdminController::class,'edit'])->name('admin#edit');
            Route::post('update/{id}',[AdminController::class, 'update'])->name('admin#update');

            //admin list
            Route::get('list',[AdminController::class,'list'])->name('admin#list');
            Route::get('delete/{id}',[AdminController::class,'delete'])->name('admin#delete');
            Route::get('change/role/{id}',[AdminController::class,'changeRole'])->name('admin#changeRole');
        });

        //product
        Route::prefix('products')->group(function(){
            Route::get('list',[ProductController::class,'list'])->name('products#list');
            Route::get('create/page',[ProductController::class,'createPage'])->name('products#createPage');
            Route::post('create',[ProductController::class, 'create'])->name('product#create');
            Route::get('delete/{id}',[ProductController::class,'delete'])->name('product#delete');
            Route::get('edit/{id}',[ProductController::class,'edit'])->name('product#edit');
            Route::get('updatePage/{id}',[ProductController::class,'updatePage'])->name('product#updatePage');
            Route::post('update',[ProductController::class,'update'])->name('product#update');
        });

        //order
        Route::prefix('order')->group(function () {
            Route::get('list',[OrderController::class,'adminOrderList'])->name('admin#orderList');
            Route::get('sortStatus',[OrderController::class,'sortStatus'])->name('admin#sortStatus');
            Route::get('ajax/changeStatus',[OrderController::class,'changeStatus'])->name('admin#changeStatus');
            Route::get('info/{order_code}',[OrderController::class,'orderInfo'])->name('admin#orderInfo');
        });

        //user list
        Route::prefix('user')->group(function(){
            Route::get('list/page',[UserController::class,'userListPage'])->name('admin#userListPage');
            Route::get('ajax/roleChange',[UserController::class,'userRoleChange'])->name('admin#userRoleChange');
            Route::get('account/delete/{id}',[UserController::class,'userAccountDelete'])->name('admin#userAccountDelete');
        });

        //contact
        Route::prefix('contact')->group(function(){
            Route::get('list',[ContactController::class,'contactList'])->name('admin#contactList');
            Route::get('delete/message/{id}',[ContactController::class,'deleteMessage'])->name('admin#deleteMessage');
        });
    });


    //user
    //home
    Route::prefix('user')->middleware(['user_auth'])->group(function () {
        //home
        Route::get('/home',[CustomerController::class,'home'])->name('user#home');
        Route::get('category/select/{id}',[CustomerController::class,'categorySelect'])->name('user#categorySelect');

        //order
        Route::prefix('order')->group(function(){
            Route::get('list',[OrderController::class,'orderList'])->name('user#orderList');
        });

        //cart
        Route::prefix('cart')->group(function(){
            Route::get('list',[CartController::class,'cartList'])->name('user#cartList');
        });

        //product
        Route::prefix('product')->group(function(){
            Route::get('details/{id}',[CustomerController::class,'details'])->name('user#details');
        });

        //password
        Route::prefix('password')->group(function(){
            Route::get('changePasswordPage',[CustomerController::class,'changePasswordPage'])->name('user#passwordChangePage');
            Route::post('changePassword',[CustomerController::class,'changePassword'])->name('user#changePassword');
        });

        //user account
        Route::prefix('account')->group(function(){
            Route::get('updateProfile',[CustomerController::class,'updateProfile'])->name('user#updateProfile');
            Route::post('update/{id}',[CustomerController::class,'update'])->name('user#update');
        });

        //ajax controller
        Route::prefix('ajax')->group(function(){
            Route::get('pizzaList',[AjaxController::class,'pizzaList'])->name('ajax#pizzaList');
            Route::get('orderCount',[AjaxController::class,'pizzaOrder'])->name('ajax#pzizzaOrder');
            Route::get('order',[AjaxController::class,'order'])->name('ajax#order');
            Route::get('clear/cart',[AjaxController::class,'clearCart'])->name('ajax#clearCart');
            Route::get('clear/cart/item',[AjaxController::class,'clearCartItem'])->name('ajax#clearCartItem');
            Route::get('view/count',[AjaxController::class,'viewCount'])->name('ajax#viewCount');
        });

        Route::prefix('contact')->group(function(){
            Route::get('page',[ContactController::class,'contactPage'])->name('user#contactPage');
            Route::post('sent',[ContactController::class,'contactSent'])->name('user#contactSent');
        });

    });

});

Route::get('testing',function(){
    $data = [
        'message' => 'this is message for web testing'
    ];

     return response()->json($data, 200);
});


