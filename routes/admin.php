<?php
use Illuminate\Support\Facades\Route;

Route::middleware('guest:admin')->group(function () {
    Route::get('login', [App\Http\Controllers\Admin\Auth\LoginController::class, "create"])->name('admin.login');
    Route::post('login', [App\Http\Controllers\Admin\Auth\LoginController::class, "store"]);

    Route::get('logout', [App\Http\Controllers\Admin\Auth\LoginController::class, "logout"])->name('admin.logout');
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
});
