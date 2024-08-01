<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\UserMiddleware;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserManagementController;
use App\Http\Middleware\LoadCategoryData;
use App\Models\Product;
use SebastianBergmann\CodeCoverage\Report\Html\CustomCssFile;

Route::get('/', [HomeController::class, 'home']);
Route::get('/home', [HomeController::class, 'home'])->name('home');

Route::middleware([
    'auth:sanctum',
    'verified',
])->group(function () {

    //Admin
    Route::group(['prefix' => 'admin', 'middleware' => AdminMiddleware::class], function () {

        Route::get('/allProducts', [ProductController::class, 'productPage'])->name('admin#product');
        Route::get('/createCategory', [CategoryController::class, 'categoryCreatePage'])->name('admin#create_category');
        Route::post('/createNewCategory', [CategoryController::class, 'createNewCategory'])->name('admin#create_new_category');
        Route::get('/productDetail/{id}', [ProductController::class, 'productDetail'])->name('admin#product_detail');
        Route::get('/createProduct', [ProductController::class, 'productCreatePage'])->name('admin#create_product');
        Route::post('/createNewProduct', [ProductController::class, 'createNewProduct'])->name('admin#create_new_product');
        Route::get('/product/edit/{id}/{category_id}', [ProductController::class, 'productEditPage'])->name('admin#product_edit');
        Route::post('/product/delete/{id}/{category_id}', [ProductController::class, 'productDelete'])->name('admin#product_delete');
        Route::post('/product/edit/save/{caetgory_id}', [ProductController::class, 'productEditSave'])->name('admin#product_edit_save');
        Route::get('/editCategory/{id}', [CategoryController::class, 'categoryEditPage'])->name('admin#edit_category');
        Route::post('/editCategory/save', [CategoryController::class, 'categoryEditSave'])->name('admin#category_edit_save');
        Route::post('/category/delete/{id}', [CategoryController::class, 'categoryDelete'])->name('admin#category_delete');
        Route::get('/setting', [AdminController::class, 'settingPage'])->name('admin#setting');
        Route::post('/settingSave', [AdminController::class, 'settingSave'])->name('admin#setting_save');
        Route::get('/setting/changePassword', [AdminController::class, 'changePasswordPage'])->name('admin#change_password');
        Route::post('/setting/changePasswordSave', [AdminController::class, 'changePasswordSave'])->name('admin#change_password_save');
        Route::post('/delete-account/{id}', [AdminController::class, 'deleteAccount'])->name('admin#delete_account');
        Route::get('/admin-management/{id}', [UserManagementController::class, 'adminManagementPage'])->name('admin#admin_management_page');
        Route::post('/admin-management/remove/{id}/{current_admin_id}', [UserManagementController::class, 'removeAdmin'])->name('admin#remove_admin');
        Route::get('/add-admin', [UserManagementController::class, 'addAdminPage'])->name('admin#add_new_admin');
        Route::post('/add-admin-save/{id}', [UserManagementController::class, 'addAdminSave'])->name('admin#add_admin_save');
        Route::get('/user-management', [UserManagementController::class, 'userManagementPage'])->name('admin#user_management_page');

        Route::get('/admin-detail/{id}', [UserManagementController::class, 'adminDetailPage'])->name('admin#admin_detail');
        Route::get('/user-detail/{id}', [UserManagementController::class, 'userDetailPage'])->name('admin#user_detail');
    });
});

//Customer
Route::group(['prefix' => 'customer', 'middleware' => UserMiddleware::class], function () {
    Route::group(['middleware' => LoadCategoryData::class], function () {
        Route::get('/shop', [ShopController::class, 'shopPage'])->name('user#shop');
        Route::get('/shop/{id}', [ShopController::class, 'shopPageByCategory'])->name('user#shop_by_category');
        Route::get('/product-details/{id}', [ShopController::class, 'productDetailsPage'])->name('user#product_details');
        Route::get('/cart', [ShopController::class, 'cartPage'])->name('user#cart');
        Route::post('/add-to-cart', [ShopController::class, 'addToCart']);
        Route::post('/remove-item', [ShopController::class, 'removeItem']);
        Route::post('/order', [ShopController::class, 'order']);
        Route::get('/order-list/{id}', [ShopController::class, 'orderList'])->name('user#order_list');
        Route::post('/delete-order/{id}', [ShopController::class, 'deleteOrder'])->name('user#delete_order');
    });

    Route::get('/setting', [CustomerController::class, 'settingPage'])->name('user#setting');
    Route::post('/update/save', [CustomerController::class, 'update'])->name('user#update_save');
    Route::post('/delete-account/{id}', [CustomerController::class, 'deleteAccount'])->name('user#delete_account');
    Route::get('/change-password', [CustomerController::class, 'changePasswordPage'])->name('user#change_password');
    Route::post('/change-password/save', [CustomerController::class, 'changePasswordSave'])->name('user#change_password_save');
});
