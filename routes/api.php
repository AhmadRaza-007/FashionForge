<?php

use App\Http\Controllers\API\AuthenticationController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\CollectionController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\SubCollectionController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {


//////////////////////////////  For Authentication  //////////////////////////////////
Route::post('login', [AuthenticationController::class, 'login']);
Route::post('register', [AuthenticationController::class, 'register']);
Route::post('forgotPassword', [AuthenticationController::class, 'forgotPassword']);
Route::post('resetPassword', [AuthenticationController::class, 'resetPassword']);


Route::group(['middleware' => 'auth:sanctum'], function () {
    //////////////////////////////  For Cart  //////////////////////////////////
    Route::get('cartProducts', [CartController::class, 'cartProducts']);
    // return $request->user();

    Route::post('logout', [AuthenticationController::class, 'logout']);
});

//////////////////////////////  For Collections  //////////////////////////////////
Route::get('collections', [CollectionController::class, 'collections']);
Route::get('collectionsWithSubCollection', [CollectionController::class, 'collectionsWithSubCollection']);

//////////////////////////////  For Sub Collections  //////////////////////////////////
Route::get('subcollections', [SubCollectionController::class, 'subCollections']);
Route::get('subcollectionsWithProducts', [SubCollectionController::class, 'subcollectionsWithProducts']);

//////////////////////////////  For Products  //////////////////////////////////
Route::get('products', [ProductController::class, 'products']);
