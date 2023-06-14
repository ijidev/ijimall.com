<?php

use App\Models\Order;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Shop\VendorOrderController;
use App\Http\Controllers\Shop\VendorProductController;

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

// Route::redirect('/', function () {
//     return view('welcome');
// });


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::controller(CartController::class)->group(function(){
        Route::get('/add-to-cart/{product}', 'add')->name('cart.add');
        Route::get('/cart', 'index')->name('cart.index');
        Route::get('/cart/update_a/{itemtId}', 'update_add')->name('cart.update');
        Route::get('/cart/update_r/{itemId}', 'update_remove')->name('cart.update_r');
        Route::get('/cart/delete/{itemId}', 'delete')->name('cart.delete');
        Route::get('/cart/checkout', 'checkout')->name('cart.checkout');
        Route::get('/cart/apply-coupon', 'coupon')->name('coupon');
    });
    Route::resource('order', OrderController::class);
});


//admin middleware routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    
    //Admin dashboard management Routes
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/admin', 'Dashboard')->name('admin.dashboard');
        Route::get('/admin/inbox', 'massage')->name('admin.indox');
        Route::get('/admin/add-catrgory', 'addCategory')->name('admin.addCat');
        Route::get('/admin/shops', 'index')->name('admin.shopIndex');
        
    });

    //Admin vendor management Routes
    Route::controller(VendorController::class)->group(function () {
        // Route::get('/dashboard', 'index')->name('admin.dashboard');
        Route::get('/admin/shops', 'index')->name('admin.shopIndex');
        Route::get('admin/shop/view/{shopId}', 'view')->name('admin.shop.view');
        Route::get('admin/shop/update/{shopId}', 'update')->name('admin.shop.update');
        Route::get('admin/shop/delete/{shopId}', 'delete')->name('admin.shop.delete');
        Route::get('admin/shop/asign/{shopId}', 'del')->name('vendor.del');
        
    });

    //Admin product management Routes
    Route::controller(ProductController::class)->group(function () {
        Route::get('/admin/add-product', 'addproduct')->name('admin.addproduct');
        Route::get('/admin/all-product', 'allproduct')->name('admin.products');
        Route::get('/admin/find-product', 'searchproduct')->name('admin.product.search');
        Route::get('/admin/create-product', 'create')->name('admin.createproduct');
        Route::get('/admin/product-action', 'action')->name('product.action');
        Route::get('/admin/delete-product/{productId}', 'delete')->name('admin.deleteProduct');
        Route::get('/admin/trash-product/{productId}', 'trash')->name('admin.trash.product');
        Route::get('/admin/restore-product/{productId}', 'restore')->name('admin.restoreProduct');
        Route::get('/admin/edit-product', 'edit')->name('admin.editProduct');
        Route::get('/admin/trashed-product', 'trashedProduct')->name('admin.trashProduct');
        Route::get('/admin/draft-product', 'draftProduct')->name('admin.product.draft');
        Route::get('/admin/pending-product', 'pendingProduct')->name('admin.product.pending');
        
    });

    //cagegory route
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/admin/categories', 'index')->name('admin.categories');
        Route::get('/create-category', 'store')->name('create.category');
        Route::get('/action', 'action')->name('action');
        Route::get('/edit-category/{subid}', 'edit')->name('admin.cat.edit');
        Route::get('/update-category/{catid}', 'update')->name('update.category');
        Route::get('/delete-category/{subid}', 'destroy')->name('admin.cat.delete');
        
    });

    //Admin Order management Routes
    Route::controller(OrdersController::class)->group(function () {
        Route::get('admin/orders/', 'allorder')->name('admin.orders');
        Route::get('admin/orders/view/{orderId}', 'details')->name('admin.order.view');
        Route::get('admin/orders/update/{orderId}', 'update')->name('admin.order.update');
        Route::get('admin/orders/delete/{orderId}', 'delete')->name('admin.order.delete');
    });  
});


// vendor shop related routes
Route::resource('vendor', ShopController::class)->middleware(['auth']);

//Vendor middleware Routes
Route::middleware(['auth', 'role:vendor'])->group(function () 
{
    Route::get('seller/setup-wizard', [ShopController::class, 'wizard'])->name('vendor.setup');
    // vendor product related routes
    route::controller(VendorProductController::class)->group(function () {
        Route::get('/Dashbord/product', 'index')->name('vendor.product');
        Route::get('/Dashbord/product/create', 'create')->name('vendor.createproduct');
        Route::get('/Dashbord/product/store', 'store')->name('vendor.storeproduct');
        Route::get('/Dashbord/product/view/{productId}', 'view')->name('vendor.viewproduct');
        Route::get('/Dashbord/product/edit/{productId}', 'edit')->name('vendor.editproduct');
        Route::get('/Dashbord/product/update/{productId}', 'update')->name('vendor.updateproduct');
        Route::get('/Dashbord/product/delete/{productId}', 'delete')->name('vendor.deleteproduct');
    });

    Route::controller(VendorOrderController::class)->group(function () {
        Route::get('Dashboard/orders/', 'index')->name('vendor.orders');
        Route::get('Dashboard/view-order/{orderId}', 'details')->name('vendor.order.view');
        Route::get('Dashboard/update-order/{orderId}', 'update')->name('vendor.order.update');
        Route::get('Dashboard/vendor/update-status', 'multiupdate')->name('vendor.multi-status');
    });
});
    

