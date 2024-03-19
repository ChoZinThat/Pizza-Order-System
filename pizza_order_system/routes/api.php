<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RouteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('testing',function(){
    $data = [
        'message' => 'this is message for api testing'
    ];

     return response()->json($data, 200);
});

Route::get('get/data',[RouteController::class,'getData'])->name('getData');
Route::post('category/create',[RouteController::class,'createCategory']);
Route::post('contact/create',[RouteController::class,'createContact']);
Route::post('category/delete',[RouteController::class,'deleteCategory']);
Route::get('category/delete/{id}',[RouteController::class,'delete_Category']);
Route::get('category/details/{id}',[RouteController::class,'details_category']);
Route::post('category/update',[RouteController::class,'updateCategory']);

/*
* get all category and product data
*localhost::8000/api/get/data (GET)

*keys -    'user_id','name' ,'email','subject','message'
* content create
*localhost::8000/api/contact/create(GET)


*keys - category_name , category_id
* category create
*localhost::8000/api/category/create (Post)

* category delete
*localhost::8000/api/category/delete/ (Post)

* category delete with post
*localhost::8000/api/category/delete/{id} (GET)

* category details
*localhost::8000/api/category/details/{id} (GET)

* category update
*localhost::8000/api/category/update (Post)



*/
