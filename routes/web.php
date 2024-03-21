<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ClotheController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\SectionController;
use App\Http\Controllers\GiftController;
use App\Http\Controllers\GoogleDriveController;
use App\Http\Controllers\SubCollectionController;
use App\Http\Controllers\UserController;
use App\Models\Order;
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
Route::get('/products', [SectionController::class, 'index'])->name('user.womenSection');
Route::get('/products/{id}', [SectionController::class, 'womenSection'])->name('user.womenSectionById');
Route::get('/products/category/{id}', [SectionController::class, 'productsByCategory'])->name('user.productByCategory');
Route::get('/productDetail/{id}', [FrontendController::class, 'productDetail'])->name('user.productDetail');
Route::get('/check/{id}', [FrontendController::class, 'check'])->name('user.check');
// Route::post('/postCart/{id}', [FrontendController::class, 'postCart'])->name('user.postCart');
Route::get('/cart', [FrontendController::class, 'cart'])->name('user.cart');
Route::post('/cartIncrement/{id}', [FrontendController::class, 'cartIncrement'])->name('user.cartIncrement');
Route::get('/cartDelete/{id}', [FrontendController::class, 'cartDelete'])->name('user.cartDelete');
// Route::post('/postBuy/{id}', [FrontendController::class, 'postCart'])->name('user.postBuy');
Route::get('/purchased', [OrderController::class, 'index'])->name('user.purchased');
Route::get('/address', [FrontendController::class, 'address'])->name('user.address');

Route::get('/gifts', [FrontendController::class, 'gifts'])->name('user.gifts');
Route::get('/gift/{id}', [FrontendController::class, 'gift'])->name('user.gift');



//////////////////////////////  Admin Login Routes  //////////////////////////////////
Route::prefix('admin')->group(function () {
    Route::get('/login', [UserController::class, 'login'])->name('admin.login');
    Route::post('/postLogin', [UserController::class, 'postLogin'])->name('admin.postLogin');
});

Route::group(['middleware' => 'auth', 'middleware' => 'AdminCheck'], function () {
    Route::prefix('admin')->group(function () {

        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('admin.dashboard');
        //////////////////////////////  For Collection  //////////////////////////////////
        Route::get('/clothingCollection', [CollectionController::class, 'index'])->name('admin.clothingCollection');
        Route::post('/addCollection', [CollectionController::class, 'create'])->name('admin.addCollection');
        Route::get('/collection/edit/{id}', [CollectionController::class, 'editCollection'])->name('admin.editCollection');
        Route::post('/updateCollection', [CollectionController::class, 'edit'])->name('admin.updateCollection');
        Route::get('/deleteCollection/{id}', [CollectionController::class, 'destroy'])->name('admin.deleteCategory');

        //////////////////////////////  For Sub Collection  //////////////////////////////////
        Route::get('/subCollection/edit/{id}', [SubCollectionController::class, 'editSubCollection'])->name('admin.editSubCollection');
        Route::post('/addSubCollection', [SubCollectionController::class, 'create'])->name('admin.addSubCollection');
        Route::post('/editSubCollection', [SubCollectionController::class, 'edit'])->name('admin.updateSubCollection');
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

        //////////////////////////////  Users  //////////////////////////////////
        Route::get('/users', [UserController::class, 'users'])->name('admin.users');

        //////////////////////////////  For Adding Products  //////////////////////////////////
        Route::get('/orders', [OrderController::class, 'orders'])->name('admin.orders');
        Route::get('/orders/pending', [OrderController::class, 'pendingOrders'])->name('admin.pendingOrders');
        Route::get('/orders/shipped', [OrderController::class, 'shippedOrders'])->name('admin.shippedOrders');
        Route::get('/orders/delivered', [OrderController::class, 'deliveredOrders'])->name('admin.deliveredOrders');
        Route::get('/order/detail/{id}', [OrderController::class, 'orderDetails'])->name('admin.orders.detail');
        Route::post('/orderstatus/update/{id}', [OrderController::class, 'orderStatus'])->name('orderStatus.update');

        //////////////////////////////  For Adding Gift  //////////////////////////////////
        Route::get('/gift', [GiftController::class, 'index']);
        Route::post('/gift/create', [GiftController::class, 'store'])->name('gift.create');
        Route::get('/gift/edit/{id}', [GiftController::class, 'edit'])->name('gift.edit');
        Route::post('/gift/update', [GiftController::class, 'update'])->name('gift.update');
        Route::get('/gift/delete/{id}', [GiftController::class, 'destroy'])->name('gift.delete');

        //////////////////////////////  For Adding Products  //////////////////////////////////
        // Route::get('/sidebar/active', function () {

        // })->name('admin.sidebar.active');
        //////////////////////////////  LogOut  //////////////////////////////////
        Route::post('/postLogout', [UserController::class, 'postLogout'])->name('admin.postLogout');
    });
    //////////////////////////////  For Sub Collection  //////////////////////////////////
    Route::get('/subCollection', [SubCollectionController::class, 'index'])->name('admin.subCollection');
    Route::get('/coll/{id}', [SubCollectionController::class, 'collection'])->name('admin.subCollectionByID');
});

Route::group(['middleware' => 'UserAuth'], function () {
    Route::get('/user', [UserController::class, 'userProfile'])->name('user.profile');
});

Route::get('/setTheme', [UserController::class, 'setTheme'])->name('setTheme');
Route::get('checkout', [FrontendController::class, 'Checkout'])->name('cart.checkout');

// Route::get('factorial/{num}', [FrontendController::class, 'factorial'])->name('slug');


Route::get('drive', function () {
    return view('admin.googledrive');
});


Route::get('getfile', [FileController::class, 'index']);
Route::post('file', [FileController::class, 'store']);



// Route::get('google/login',[GoogleDriveController::class,'googleLogin'])->name('google.login');
// Route::get('google-drive/file-upload',[GoogleDriveController::class,'googleDriveFilePpload'])->name('google.drive.file.upload');

Route::get('google/login', [GoogleDriveController::class, 'provider'])->name('google.login');
Route::get('google/callback', [GoogleDriveController::class, 'callbackHandle'])->name('google.callback');
