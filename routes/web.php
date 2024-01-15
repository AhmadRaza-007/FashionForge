<?php

use App\Http\Controllers\ClotheController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\SectionController;
use App\Http\Controllers\SubCollectionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('app');
// });


Route::get('/login', [UserController::class, 'frontLogin'])->name('user.login');
Route::post('/post/login', [UserController::class, 'postFrontLogin'])->name('user.postLogin');
Route::get('/signup', [UserController::class, 'frontSignup'])->name('user.signup');
Route::post('/post/signup', [UserController::class, 'postFrontSignup'])->name('user.postSignup');

Route::redirect('/', '/home', 301);
Route::get('/home', [FrontendController::class, 'index'])->name('user.homeSection');
Route::get('/category/{id}', [FrontendController::class, 'category'])->name('user.category');
Route::post('/completeOrder', [FrontendController::class, 'completeOrder'])->name('user.completeOrder');
Route::get('/womenSection', [SectionController::class, 'index'])->name('user.womenSection');
Route::get('/womenSection/{id}', [SectionController::class, 'womenSection'])->name('user.womenSectionById');
Route::get('/productDetail/{id}', [FrontendController::class, 'productDetail'])->name('user.productDetail');
Route::get('/check/{id}', [FrontendController::class, 'check'])->name('user.check');
// Route::post('/postCart/{id}', [FrontendController::class, 'postCart'])->name('user.postCart');
Route::get('/cart', [FrontendController::class, 'cart'])->name('user.cart');
Route::post('/cartIncrement/{id}', [FrontendController::class, 'cartIncrement'])->name('user.cartIncrement');
Route::get('/cartDelete/{id}', [FrontendController::class, 'cartDelete'])->name('user.cartDelete');
// Route::post('/postBuy/{id}', [FrontendController::class, 'postCart'])->name('user.postBuy');
Route::get('/buyNow', [FrontendController::class, 'cart'])->name('user.buyNow');

//////////////////////////////  Admin Login Routes  //////////////////////////////////
Route::prefix('admin')->group(function () {
    Route::get('/login', [UserController::class, 'login'])->name('admin.login');
    Route::post('/postLogin', [UserController::class, 'postLogin'])->name('admin.postLogin');
});

Route::group(['middleware' => 'auth', 'middleware' => 'AdminCheck'], function () {
    Route::prefix('admin')->group(function () {

        //////////////////////////////  For Collection  //////////////////////////////////
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/clothingCollection', [CollectionController::class, 'index'])->name('admin.clothingCollection');
        Route::post('/addCollection', [CollectionController::class, 'create'])->name('admin.addCollection');
        Route::get('/collection/edit/{id}', [CollectionController::class, 'editCollection']);
        Route::post('/updateCollection', [CollectionController::class, 'edit'])->name('admin.editCollection');
        Route::get('/deleteCollection/{id}', [CollectionController::class, 'destroy'])->name('admin.deleteCategory');

        //////////////////////////////  For Sub Collection  //////////////////////////////////
        Route::get('/subCollection/edit/{id}', [SubCollectionController::class, 'editSubCollection']);
        Route::post('/addSubCollection', [SubCollectionController::class, 'create'])->name('admin.addSubCollection');
        Route::post('/editSubCollection', [SubCollectionController::class, 'edit'])->name('admin.editSubCollection');
        Route::get('/deleteSubCollection/{id}', [SubCollectionController::class, 'destroy'])->name('admin.deleteSubCategory');

        //////////////////////////////  For Adding Products  //////////////////////////////////
        Route::get('/clothes', [ClotheController::class, 'index'])->name('admin.clothes');
        Route::get('/editClothes/{id}', [ClotheController::class, 'editClothes'])->name('admin.editClothes');
        Route::post('/updateClothes', [ClotheController::class, 'update'])->name('admin.updateClothes');
        Route::get('/clothes/{id}', [ClotheController::class, 'productById'])->name('admin.productById');
        Route::post('/add/clothes', [ClotheController::class, 'create'])->name('admin.addClothes');
        Route::get('/delete/clothes/{id}', [ClotheController::class, 'destroy'])->name('admin.deleteClothes');
        Route::get('/delete/clotheImage/{id}', [ClotheController::class, 'destroyImage'])->name('admin.deleteClothesImage');
        Route::get('/delete/clotheSize/{clotheId}/{sizeId}', [ClotheController::class, 'destroySize'])->name('admin.destroySize');
        Route::get('/delete/clotheColor/{clotheId}/{colorId}', [ClotheController::class, 'destroyColor'])->name('admin.destroyColor');

        //////////////////////////////  LogOut  //////////////////////////////////
        Route::post('/postLogout', [UserController::class, 'postLogout'])->name('admin.postLogout');
    });
    //////////////////////////////  For Sub Collection  //////////////////////////////////
    Route::get('/subCollection', [SubCollectionController::class, 'index'])->name('admin.subCollection');
    Route::get('/coll/{id}', [SubCollectionController::class, 'collection']);
});


Route::get('checkout', [FrontendController::class, 'Checkout'])->name('cart.checkout');
// Route::get('factorial/{num}', [FrontendController::class, 'factorial'])->name('slug');
