<?php

use App\Models\Order;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ProductController as FrontProduct;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Controllers\Shop\SellerController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\VendorController;
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
Route::get('/currency/{name}', [App\Http\Controllers\HomeController::class, 'currency'])->name('user.currency');

Route::middleware(['auth'])->group(function () {
    Route::controller(CartController::class)->group(function(){
        Route::get('/add-to-cart/{product}', 'add')->name('cart.add');
        Route::get('/cart', 'index')->name('cart.index');
        Route::get('/cart/update_a/{itemtId}', 'updateCart')->name('cart.update');
        Route::get('/cart/update_r/{itemId}', 'update_remove')->name('cart.update_r');
        Route::get('/cart/delete/{itemId}', 'delete')->name('cart.delete');
        Route::get('/cart/checkout', 'checkout')->name('cart.checkout');
        Route::get('/cart/apply-coupon', 'coupon')->name('coupon');
    });
    Route::resource('order', OrderController::class);
});

Route::controller(FrontProduct::class)->group(function () {
    Route::get('/product/{id}', 'index')->name('product.single');
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

    //Admin user controller
    Route::controller(UserController::class)->group(function () {
        Route::get('/admin/users', 'users')->name('admin.users');
        Route::get('/admin/users/customer', 'customerUser')->name('admin.users.customer');
        Route::get('/admin/users/vendors', 'vendorUser')->name('admin.users.vendor');

        Route::get('/admin/users/search', 'userSearch')->name('admin.user.search');
        Route::get('/admin/users/search/email', 'emailSearch')->name('admin.email.search');
        Route::get('/admin/users/action', 'userAction')->name('admin.user.action');

        Route::get('/admin/user/create', 'addUser')->name('admin.user.add');
        Route::get('/admin/user/store', 'storeUser')->name('admin.store.user');
        Route::get('/admin/user/edit/{id}', 'editUser')->name('admin.edit.user');
        Route::get('/admin/user/manage/{id}', 'manageUser')->name('admin.manage.user');
        Route::get('/admin/user/fund/{id}', 'fundUser')->name('admin.fund.user');
        Route::get('/admin/user/delete/{id}', 'deleteUser')->name('admin.trash.user');
        
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
    
    //Admin withdrawal management
    Route::controller(WithdrawalController::class)->group(function () {
        Route::get('admin/withdrawal/', 'withdrawRequest')->name('withdrawal.request');
        Route::get('admin/withdrawal/view/{id}', 'view')->name('withdraw.view');
        Route::get('admin/withdrawal/approve/{id}', 'approve')->name('withdraw.approve');
        Route::get('admin/withdrawal/decline/{id}', 'decline')->name('withdraw.decline');
        Route::get('admin/withdrawal/delete/{id}', 'delete')->name('withdraw.delete');
        
    });

    //Admin product management Routes
    Route::controller(ProductController::class)->group(function () {
        Route::get('/admin/product', 'allproduct')->name('admin.products');

        
        Route::get('/admin/add-product', 'addproduct')->name('admin.addproduct');
        Route::get('/admin/create-product', 'create')->name('admin.createproduct');
        
        Route::get('/admin/delete-product/{productId}', 'delete')->name('admin.deleteProduct');
        Route::get('/admin/trash-product/{productId}', 'trash')->name('admin.trash.product');
        Route::get('/admin/restore-product/{productId}', 'restore')->name('admin.restoreProduct');
        Route::get('/admin/edit-product', 'edit')->name('admin.editProduct');
        
        Route::get('/admin/find-product', 'searchproduct')->name('admin.product.search');
        Route::get('/admin/product-action', 'action')->name('product.action');
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
        
        Route::get('admin/orders/action', 'multiselect')->name('admin.multiaction');

        Route::get('admin/order/view/{orderId}', 'details')->name('admin.order.view');
        Route::get('admin/order/manage/{orderId}', 'manageSub')->name('admin.suborder.view'); #manage suborder

        Route::get('admin/order/update/{orderId}', 'update')->name('admin.order.update');
        Route::get('admin/suborder/update/{orderId}', 'updateSub')->name('admin.suborder.update');

        Route::get('admin/orders/delete/{orderId}', 'delete')->name('admin.order.delete');
        Route::get('admin/suborders/delete/{orderId}', 'delete')->name('admin.suborder.delete');

        Route::get('admin/orders/find/{orderId}', 'find')->name('admin.find.order');
    });  

    //Admin settings route
    Route::controller(SettingController::class)->group(function () {
        Route::get('/admin/settings', 'index')->name('admin.setting');
        Route::get('/admin/settings/save', 'update')->name('admin.setting.update');
        // Route::post('/orders', 'store');
    });

    Route::controller(CurrencyController::class)->group(function () {
        Route::get('/admin/settings/curency', 'store')->name('admin.currency.add');
        Route::get('/admin/settings/edit-curency/{id}', 'edit')->name('admin.currency.edit');
        Route::get('/admin/settings/update-curency/{id}', 'update')->name('admin.currency.update');
        Route::get('/admin/settings/delete-curency/{id}', 'delete')->name('admin.currency.delete');
        // Route::post('/orders', 'store');
    });
});


// vendor shop related routes
Route::resource('vendor', ShopController::class)->middleware(['auth']);

//Vendor middleware Routes
Route::middleware(['auth', 'role:vendor'])->group(function () 
{
    Route::controller(ShopController::class)->group(function () {
        Route::get('seller/wizard/welcome', 'wizard')->name('wizard.welcome');
        Route::get('seller/wizard/accountinfo', 'accountInfo')->name('wizard.accountInfo');
        Route::get('seller/wizard/skip-info', 'skipInfo')->name('wizard.info.skip');
        Route::get('seller/wizard/payment', 'paymentInfo')->name('wizard.payment');
        Route::get('seller/wizard/finish', 'finish')->name('wizard.finish');

        // Route::get('Dashboard/payment-setup', 'paymentInfo')->name('vendor.payment');
        Route::get('Dashboard/store-setup', 'storeInfo')->name('vendor.store');
        
    });

    // vendor product related routes
    route::controller(VendorProductController::class)->group(function () {
        Route::get('/Dashboard/product', 'index')->name('vendor.product');
        Route::get('/Dashboard/product/all', 'allP')->name('vendor.all.product');
        Route::get('/Dashboard/product/pending', 'pending')->name('vendor.pending.product');
        Route::get('/Dashboard/product/draft', 'draft')->name('vendor.draft.product');
        Route::get('/Dashboard/product/trashed', 'trashed')->name('vendor.trashed.product');
        
        Route::get('/Dashboard/product/create', 'create')->name('vendor.createproduct');
        Route::get('/Dashboard/product/store', 'store')->name('vendor.storeproduct');
        Route::get('/Dashboard/product/edit/{productId}', 'edit')->name('vendor.editproduct');
        Route::get('/Dashboard/product/update/{productId}', 'update')->name('vendor.updateproduct');
        
        Route::get('/Dashboard/product/view/{productId}', 'view')->name('vendor.viewproduct');
        
        Route::get('/Dashboard/product-action', 'multiaction')->name('vendor.product.action');

        Route::get('/Dashboard/product/trash/{productId}', 'trash')->name('vendor.trash.product');
        Route::get('/Dashboard/product/restore/{productId}', 'restore')->name('vendor.restore.product');
        Route::get('/Dashboard/product/delete/{productId}', 'delete')->name('vendor.deleteproduct');
    });

    Route::controller(VendorOrderController::class)->group(function () {
        Route::get('Dashboard/orders/', 'index')->name('vendor.orders');
        Route::get('Dashboard/orders/pending', 'uncomplete')->name('vendor.order.uncomplete');
        Route::get('Dashboard/view-order/{orderId}', 'details')->name('vendor.order.view');
        Route::get('Dashboard/update-order/{orderId}', 'update')->name('vendor.order.update');
        Route::get('Dashboard/vendor/update-status', 'multiupdate')->name('vendor.multi-status');
    });

    Route::controller(WithdrawalController::class)->group(function () {
        Route::get('/Dashboard/withdrawal', 'withdrawal')->name('vendor.withdrawal');
        Route::get('/Dashboard/withdrawal/rerquest', 'reqWithdraw')->name('withdraw.request');
        // Route::post('/orders', 'store');
    });

    Route::controller(CouponController::class)->group(function () {
        Route::get('/Dashboard/coupons', 'index')->name('vendor.coupon');
        Route::get('/Dashboard/coupons/expired', 'expired')->name('vendor.coupon.expired');
        Route::get('/Dashboard/coupon/edit/{id}', 'edit')->name('vendor.coupon.edit');
        Route::get('/Dashboard/coupon/store', 'store')->name('vendor.coupon.store');
        Route::get('/Dashboard/coupon/update/{id}', 'update')->name('vendor.coupon.update');
        Route::get('/Dashboard/coupon/action', 'action')->name('vendor.coupon.action');
        Route::get('/Dashboard/coupon/delete/{id}', 'delete')->name('vendor.coupon.delete');
    });
});
    

