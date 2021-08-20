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

    //logar usuário
    Route::post('login', [AuthController::class, 'login']);
    //registrar usuário
    Route::post('register', [AuthController::class, 'register']);


    Route::prefix( 'me')->group( function(){    

    //pegar informações do usuário atutenticado    
    Route::get('', [MeController::class, 'index'])->middleware( 'auth:api');
    //atualizar informações do usuário atutenticado
    Route::put('', [MeController::class, 'update'])->middleware( 'auth:api');
  
    });


    Route::prefix( 'categories')->group( function(){   

    //pegar todas as categorias do usuário   
    Route::get('', [CategoryController::class, 'index'])->middleware( 'auth:api');
    //pegar uma categoria do usuário       
    Route::get('{category}', [CategoryController::class, 'show'])->middleware( 'auth:api');
    //criar categorias   
    Route::post('', [CategoryController::class, 'store'])->middleware( 'auth:api');
    //atualizar categoria
    Route::put('{category}', [CategoryController::class, 'update'])->middleware( 'auth:api');
    //excluir categoria
    Route::delete('{category}', [CategoryController::class, 'destroy'])->middleware( 'auth:api');
    //criar produto com uma categoria já criada
    Route::post('{category}/products', [CategoryController::class, 'addProducts'])->middleware( 'auth:api');

  
    });

    Route::prefix( 'products')->group( function(){

    //pegar todos os produtos de um usuário
    Route::get( '', [ProductController::class, 'index'])->middleware( 'auth:api');
    //mostrar apenas um produto do usuário
    Route::get( '{product}', [ProductController::class, 'show'])->middleware( 'auth:api');
    //atualizar produto do usuário
    Route::put( '{product}', [ProductController::class, 'update'])->middleware( 'auth:api');
    //deletar produto od usuário
    Route::delete( '{product}', [ProductController::class, 'destroy'])->middleware( 'auth:api');
    //adicionar 3 fotos por produto do usuário
    Route::post( '{product}/upload',[ImageController::class, 'addPhotos'])->middleware( 'auth:api');
    //deletar uma foto de um produto do usuário
    Route::delete( '{product}/upload/{image}',[ImageController::class, 'destroy'])->middleware( 'auth:api');
   



    });  
  
});







Route::get('/', function(){
    return 'Teste api kkkk';
});




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
