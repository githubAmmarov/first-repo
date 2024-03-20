<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\WarehousesController;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// this is for user details
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public Routes
//////////////////////////////////////////////////////

// Auth Controllers
//======================================

Route::post('/pharmacistRegister',[AuthController::class,'pharmacistRegister']);

Route::post('/ownerRegister',[AuthController::class,'ownerRegister']);

Route::post('/login',[AuthController::class,'login']);

//======================================

// Products Controllers
//======================================

// هاد لا تربطوه هلق 
Route::post('/list',[ProductsController::class,'index']);


//======================================

// Warehouse Controllers
//======================================
Route::get('/warehouses',[WarehousesController::class,'show']);

Route::get('/warehouseproducts',[WarehousesController::class,'category']);

Route::get('/productDetails',[WarehousesController::class,'details']);

Route::get('/search',[WarehousesController::class,'search']);

//////////////////////////////////////////////////////

// Protected Routes
Route::group(['middleware'=>['auth:sanctum']], function(){
    
    Route::post('/logout',[AuthController::class,'logout']);

    Route::post('/closeCart',[OrdersController::class,'closecart']);

    Route::post('/addToCart',[OrdersController::class,'addtocart']);

    Route::delete('/deleteOrder',[OrdersController::class,'deleteorder']);

    Route::get('/price',[OrdersController::class,'getProductPrice']);

    Route::get('/totalPrice',[OrdersController::class,'getProductTotalprice']);
    
    Route::get('/orderPrice',[OrdersController::class,'orderPrice']);

    Route::get('/getOrderItems',[OrdersController::class,'getOrderProductWarehouse']);

    Route::get('/getOrders',[OrdersController::class,'getOrders']);

    
});