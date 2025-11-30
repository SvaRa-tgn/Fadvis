<?php

use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\RecoveryRequestController;
use App\Http\Controllers\Auth\ResetFormPasswordController;
use App\Http\Controllers\WEB\Admin\AdminController;
use App\Http\Controllers\WEB\Admin\ColorController;
use App\Http\Controllers\WEB\Admin\UserController;
use App\Http\Controllers\WEB\Index\IndexController;
use App\Http\Controllers\WEB\Page\PageController;
use App\Http\Controllers\WEB\Admin\CategoryController;
use App\Http\Controllers\WEB\Page\ProductController;
use App\Http\Controllers\WEB\Profile\OrderController;
use App\Http\Controllers\WEB\Profile\PatientController;
use App\Http\Controllers\WEB\Profile\ProfileController;
use App\Http\Controllers\WEB\RegistrationMaster\RegistrationMasterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

//СТРАНИЦЫ
Route::get('/', [IndexController::class, 'index'])->name('main');
Route::get('/catalog', [PageController::class, 'showCatalog'])->name('show.catalog');
Route::get('/category/{category}', [PageController::class, 'showCategory'])->name('show.category');
Route::get('/product/{product}', [PageController::class, 'showProduct'])->name('show.product');
Route::get('/proposal-price', [PageController::class, 'showPriceForm'])->name('show.price.form');
Route::get('/proposal-prothesis', [PageController::class, 'showProthesisForm'])->name('show.prothesis.form');

Route::get('/check', [IndexController::class, 'check'])->name('check');

//Регистрация владельца сайта
Route::prefix('/master')->group(function () {
    Route::get('/registration/form', [RegistrationMasterController::class, 'show'])->name('master.user');
});

//Восстановление пароля
Route::post(
    uri: '/forgot-password',
    action: [RecoveryRequestController::class, 'recovery']
    )->middleware('guest')->name('recovery.email');

Route::get(
    uri: '/reset/password/{token}',
    action: [ResetFormPasswordController::class, 'resetForm'],
    )->middleware('guest')->name('reset.password');

//Админка
Route::prefix('admin')->middleware('master.access')->group(function () {
    Route::get('/private/{role}/{user}', [AdminController::class, 'show'])->name('admin.user.show');
    Route::get('/update/{role}/{id}', [AdminController::class, 'showUpdate'])->name('admin.show.update');

    Route::prefix('users')->group(function () {
        Route::get('/list', [UserController::class, 'list'])->name('admin.user.list');
        Route::get('/create', [UserController::class, 'create'])->name('admin.user.create');
        Route::get('/update/{user}', [UserController::class, 'update'])->name('admin.user.update');
    });

    Route::prefix('category')->group(function () {
        Route::get('/list', [CategoryController::class, 'list'])->name('admin.category.list');
        Route::get('/create', [CategoryController::class, 'create'])->name('admin.category.create');
        Route::get('/update/{category}', [CategoryController::class, 'update'])->name('admin.category.update');
    });

    Route::prefix('color')->group(function () {
        Route::get('/list', [ColorController::class, 'list'])->name('admin.color.list');
        Route::get('/create', [ColorController::class, 'create'])->name('admin.color.create');
        Route::get('/update/{color}', [ColorController::class, 'update'])->name('admin.color.update');
    });

    Route::prefix('product')->group(function () {
        Route::get('/list', [ProductController::class, 'list'])->name('admin.product.list');
        Route::get('/create', [ProductController::class, 'create'])->name('admin.product.create');
        Route::get('/update/{product}', [ProductController::class, 'update'])->name('admin.product.update');
    });
});

//Личный кабинет пользователя
Route::prefix('/profile')->middleware('auth')->group(function () {
   Route::get('/private/{role}/{slug}', [ProfileController::class, 'show'])->name('profile.user.show');

   Route::prefix('{user}/patient')->group(function () {
       Route::get('/list', [PatientController::class, 'list'])->name('profile.patient.list');
       Route::get('/create', [PatientController::class, 'create'])->name('profile.patient.create');
       Route::get('/update/{patient}', [PatientController::class, 'update'])->name('profile.patient.update');
   });

   Route::prefix('{user}/order')->group(function () {
       Route::get('/list', [OrderController::class, 'list'])->name('profile.order.list');
       Route::get('/create', [OrderController::class, 'create'])->name('profile.order.create');
       Route::get('/create/{id}', [OrderController::class, 'createItem'])->name('profile.order.createItem');
       Route::get('/update/{order}', [OrderController::class, 'update'])->name('profile.order.update');
       Route::get('/show', [OrderController::class, 'show'])->name('profile.order.show');
   });
});













Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
