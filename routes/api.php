<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MeController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::prefix( 'v1')->group( function(){
    
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);


    Route::prefix( 'me')->group( function(){    
   
    Route::get('', [MeController::class, 'index'])->middleware( 'auth:api');
    Route::put('', [MeController::class, 'update'])->middleware( 'auth:api');
  
    });


    Route::prefix( 'categories')->group( function(){    
   
    Route::get('', [CategoryController::class, 'index'])->middleware( 'auth:api');
    Route::get('{category}', [CategoryController::class, 'show'])->middleware( 'auth:api');
    Route::post('', [CategoryController::class, 'store'])->middleware( 'auth:api');
    Route::put('{category}', [CategoryController::class, 'update'])->middleware( 'auth:api');
    Route::delete('{category}', [CategoryController::class, 'destroy'])->middleware( 'auth:api');
    Route::post('{category}/products', [CategoryController::class, 'addProducts'])->middleware( 'auth:api');

  
    });

    Route::prefix( 'products')->group( function(){

    Route::get( '', [ProductController::class, 'index'])->middleware( 'auth:api');
    Route::get( '{product}', [ProductController::class, 'show'])->middleware( 'auth:api');
    Route::put( '{product}', [ProductController::class, 'update'])->middleware( 'auth:api');
    Route::delete( '{product}', [ProductController::class, 'destroy'])->middleware( 'auth:api');
    Route::post( '{product}/upload',[ImageController::class, 'addPhotos'])->middleware( 'auth:api');



    });  
  
});







Route::get('/', function(){
    return 'Teste api kkkk';
});




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
