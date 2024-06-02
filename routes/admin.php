<?php
use Illuminate\Support\Facades\Route;

Route::middleware('guest:admin')->group(function () {
    Route::get('login', [App\Http\Controllers\Admin\Auth\LoginController::class, "create"])->name('admin.login');
    Route::post('login', [App\Http\Controllers\Admin\Auth\LoginController::class, "store"]);


});


Route::middleware(['auth.admin'])->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, "index"])->name('admin.home');

    Route::group(['prefix' => 'users'], function(){
        Route::get('/', [App\Http\Controllers\Admin\UserController::class, "index"])->name('admin.users_index');
        Route::get('create', [App\Http\Controllers\Admin\UserController::class, "create"])->name('admin.users_create');
        Route::post('create', [App\Http\Controllers\Admin\UserController::class, "store"])->name('admin.users_store');
        Route::get('edit/{user}', [App\Http\Controllers\Admin\UserController::class, "edit"])->name('admin.users_edit');
        Route::post('update/{user}', [App\Http\Controllers\Admin\UserController::class, "update"])->name('admin.users_update');
        Route::post('delete', [App\Http\Controllers\Admin\UserController::class, "delete"])->name('admin.users_delete');
    });

    # profile admin
    Route::group(['prefix' => 'profile'], function(){
        Route::get('/change-profile', [App\Http\Controllers\Admin\ProfileController::class, "changeProfile"])->name('admin.profile_change-profile');
        Route::post('/change-profile', [App\Http\Controllers\Admin\ProfileController::class, "updateProfile"])->name('admin.profile_update-profile');
        Route::get('/change-password', [App\Http\Controllers\Admin\ProfileController::class, "changePassword"])->name('admin.profile_change-password');
        Route::post('/change-password', [App\Http\Controllers\Admin\ProfileController::class, "updatePassword"])->name('admin.profile_update-password');
    });

    #category
    Route::group(['prefix' => 'categories'], function(){
        Route::get('/', [App\Http\Controllers\Admin\CategoryController::class, "index"])->name('admin.category_index');
        Route::get('create', [App\Http\Controllers\Admin\CategoryController::class, "create"])->name('admin.category_create');
        Route::post('create', [App\Http\Controllers\Admin\CategoryController::class, "store"])->name('admin.category_store');
        Route::get('edit/{category}', [App\Http\Controllers\Admin\CategoryController::class, "edit"])->name('admin.category_edit');
        Route::post('update/{category}', [App\Http\Controllers\Admin\CategoryController::class, "update"])->name('admin.category_update');
        Route::post('delete', [App\Http\Controllers\Admin\CategoryController::class, "delete"])->name('admin.category_delete');
    });

    #product
    Route::group(['prefix' => 'products'], function(){
        Route::get('/', [App\Http\Controllers\Admin\ProductController::class, "index"])->name('admin.product_index');
        Route::get('create', [App\Http\Controllers\Admin\ProductController::class, "create"])->name('admin.products_create');
        Route::post('create', [App\Http\Controllers\Admin\ProductController::class, "store"])->name('admin.products_store');
        Route::get('update/{product}', [App\Http\Controllers\Admin\ProductController::class, "edit"])->name('admin.products_edit');
        Route::post('update/{product}', [App\Http\Controllers\Admin\ProductController::class, "update"])->name('admin.products_update');
        Route::post('delete', [App\Http\Controllers\Admin\ProductController::class, "delete"])->name('admin.products_delete');

        Route::get('get-categories-by-parent', [App\Http\Controllers\Admin\ProductController::class, "getCategoryByParent"])->name('admin.category_by_parent');

        Route::get('color/{product}', [App\Http\Controllers\Admin\ProductController::class, "createColor"])->name('admin.products_color');
        Route::post('color/{product}', [App\Http\Controllers\Admin\ProductController::class, "storeColor"])->name('admin.products_color_store');
        Route::get('color-update/{productColor}', [App\Http\Controllers\Admin\ProductController::class, "editColor"])->name('admin.products_color_edit');
        Route::post('color-update/{productColor}', [App\Http\Controllers\Admin\ProductController::class, "updateColor"])->name('admin.products_color_update');
        Route::post('color-delete/{productColor}', [App\Http\Controllers\Admin\ProductController::class, "deleteColor"])->name('admin.products_color_delete');

        Route::get('size/{product}', [App\Http\Controllers\Admin\ProductController::class, "createSize"])->name('admin.products_size');
        Route::get('size-by-product-color', [App\Http\Controllers\Admin\ProductController::class, "getSizeByProductColor"])->name('admin.size_by_product_color');
        Route::get('size-by-product-color-edit/{productSize}', [App\Http\Controllers\Admin\ProductController::class, "getSizeByProductColorEdit"])->name('admin.size_by_product_color_edit');
        Route::post('store-size-product/{product}', [App\Http\Controllers\Admin\ProductController::class, "storeSizeProduct"])->name('admin.store_size_product');
        Route::post('delete-size-product/{productSize}', [App\Http\Controllers\Admin\ProductController::class, "deleteSizeProduct"])->name('admin.delete_size_product');
        Route::get('update-size-product/{productSize}/{product}', [App\Http\Controllers\Admin\ProductController::class, "editSizeProduct"])->name('admin.update_size_product');
        Route::post('update-size-product/{productSize}/{product}', [App\Http\Controllers\Admin\ProductController::class, "updateSizeProduct"])->name('admin.update_size_product');

        Route::get('image/{product}', [App\Http\Controllers\Admin\ProductController::class, "createImage"])->name('admin.products_image');
        Route::post('image/{product}', [App\Http\Controllers\Admin\ProductController::class, "storeImage"])->name('admin.products_image_store');
        Route::get('image-update/{productImage}', [App\Http\Controllers\Admin\ProductController::class, "editImage"])->name('admin.products_image_edit');
        Route::post('image-update/{productImage}', [App\Http\Controllers\Admin\ProductController::class, "updateImage"])->name('admin.products_image_update');
        Route::post('image-delete/{productImage}', [App\Http\Controllers\Admin\ProductController::class, "deleteImage"])->name('admin.products_image_delete');
    });

    #Color
    Route::group(['prefix' => 'colors'], function(){
        Route::get('/', [App\Http\Controllers\Admin\ColorController::class, "index"])->name('admin.colors_index');
        Route::get('create', [App\Http\Controllers\Admin\ColorController::class, "create"])->name('admin.colors_create');
        Route::post('create', [App\Http\Controllers\Admin\ColorController::class, "store"])->name('admin.colors_store');
        Route::get('edit/{color}', [App\Http\Controllers\Admin\ColorController::class, "edit"])->name('admin.colors_edit');
        Route::post('update/{color}', [App\Http\Controllers\Admin\ColorController::class, "update"])->name('admin.colors_update');
        Route::post('delete', [App\Http\Controllers\Admin\ColorController::class, "delete"])->name('admin.colors_delete');
    });

    #size
    Route::group(['prefix' => 'sizes'], function(){
        Route::get('/', [App\Http\Controllers\Admin\SizeController::class, "index"])->name('admin.sizes_index');
        Route::get('create', [App\Http\Controllers\Admin\SizeController::class, "create"])->name('admin.sizes_create');
        Route::post('create', [App\Http\Controllers\Admin\SizeController::class, "store"])->name('admin.sizes_store');
        Route::get('edit/{size}', [App\Http\Controllers\Admin\SizeController::class, "edit"])->name('admin.sizes_edit');
        Route::post('update/{size}', [App\Http\Controllers\Admin\SizeController::class, "update"])->name('admin.sizes_update');
        Route::post('delete', [App\Http\Controllers\Admin\SizeController::class, "delete"])->name('admin.sizes_delete');
    });

    #brand
    Route::group(['prefix' => 'brands'], function(){
        Route::get('/', [App\Http\Controllers\Admin\BrandController::class, "index"])->name('admin.brands_index');
        Route::get('create', [App\Http\Controllers\Admin\BrandController::class, "create"])->name('admin.brands_create');
        Route::post('create', [App\Http\Controllers\Admin\BrandController::class, "store"])->name('admin.brands_store');
        Route::get('edit/{brand}', [App\Http\Controllers\Admin\BrandController::class, "edit"])->name('admin.brands_edit');
        Route::post('update/{brand}', [App\Http\Controllers\Admin\BrandController::class, "update"])->name('admin.brands_update');
        Route::post('delete', [App\Http\Controllers\Admin\BrandController::class, "delete"])->name('admin.brands_delete');
    });

    #payment metthod
    Route::group(['prefix' => 'payments'], function(){
        Route::get('/', [App\Http\Controllers\Admin\PaymentMethodController::class, "index"])->name('admin.payments_index');
        //Route::get('create', [App\Http\Controllers\Admin\PaymentMethodController::class, "create"])->name('admin.payments_create');
        //Route::post('create', [App\Http\Controllers\Admin\PaymentMethodController::class, "store"])->name('admin.payments_store');
        Route::get('edit/{payment}', [App\Http\Controllers\Admin\PaymentMethodController::class, "edit"])->name('admin.payments_edit');
        Route::post('edit/{payment}', [App\Http\Controllers\Admin\PaymentMethodController::class, "update"])->name('admin.payments_update');
    });

    #order
    Route::group(['prefix' => 'orders'], function(){
        Route::get('/', [App\Http\Controllers\Admin\OrderController::class, "index"])->name('admin.orders_index');
        //Route::get('create', [App\Http\Controllers\Admin\OrderController::class, "create"])->name('admin.orders_create');
        //Route::post('create', [App\Http\Controllers\Admin\OrderController::class, "store"])->name('admin.orders_store');
        Route::get('edit/{order}', [App\Http\Controllers\Admin\OrderController::class, "edit"])->name('admin.orders_edit');
        Route::post('update/{order}', [App\Http\Controllers\Admin\OrderController::class, "update"])->name('admin.orders_update');
        Route::post('delete', [App\Http\Controllers\Admin\OrderController::class, "delete"])->name('admin.orders_delete');
    });

    Route::get('logout', [App\Http\Controllers\Admin\Auth\LoginController::class, "logout"])->name('admin.logout');
});
