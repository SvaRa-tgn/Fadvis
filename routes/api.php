<?php

use App\Http\Controllers\API\Admin\Category\ApiCategoryController;
use App\Http\Controllers\API\Admin\Color\ApiColorController;
use App\Http\Controllers\API\Admin\Product\ApiImageController;
use App\Http\Controllers\API\Admin\Product\ApiProductController;
use App\Http\Controllers\API\Admin\User\ApiUserController;
use App\Http\Controllers\API\Page\ApiPageController;
use App\Http\Controllers\API\Profile\ApiOrderController;
use App\Http\Controllers\API\Profile\ApiPatientController;
use App\Http\Controllers\API\RegistrationMaster\ApiRegistrationMasterController;
use App\Http\Controllers\Auth\NewPasswordController;
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

Route::prefix('/v1/master')->group(function () {
   Route::post('/create', [ApiRegistrationMasterController::class, 'create'])->name('api.v1.master.create');
});

Route::post(
    uri: '/new-password',
    action: [NewPasswordController::class, 'newPassword'],
)->middleware('guest')->name('api.v1.new.password');

Route::prefix('/v1/admin')->middleware('auth:sanctum')->group(function () {
    Route::prefix('/master')->group(function () {
        Route::put('/update/{id}', [ApiUserController::class, 'update'])->name('api.v1.admin.update');
    });

    Route::prefix('/user')->group(function () {
        Route::post('/create', [ApiUserController::class, 'create'])->name('api.v1.user.create');
        Route::patch('/update/{id}', [ApiUserController::class, 'update'])->name('api.v1.user.update');
        Route::put('/change-password/{id}', [ApiUserController::class, 'changePassword'])->name('api.v1.user.changePassword');
    });

    Route::prefix('/category')->group(function () {
        Route::post('/create', [ApiCategoryController::class, 'create'])->name('api.v1.category.create');
        Route::patch('/update/{id}', [ApiCategoryController::class, 'update'])->name('api.v1.category.update');
    });

    Route::prefix('/color')->group(function () {
        Route::post('/create', [ApiColorController::class, 'create'])->name('api.v1.color.create');
        Route::patch('/update/{id}', [ApiColorController::class, 'update'])->name('api.v1.color.update');
    });

    Route::prefix('/product')->group(function () {
        Route::post('/create', [ApiProductController::class, 'create'])->name('api.v1.product.create');
        Route::patch('/update/{id}', [ApiProductController::class, 'update'])->name('api.v1.product.update');
        Route::post('/image/add/{product}', [ApiImageController::class, 'add'])->name('api.v1.image.add');
        Route::patch('/image/update/{product}/{image}', [ApiImageController::class, 'update'])->name('api.v1.image.update');
        Route::delete('/image/delete/{image}', [ApiImageController::class, 'delete'])->name('api.v1.image.delete');
    });
});

Route::prefix('/v1/profile')->middleware('auth:sanctum')->group(function () {
    Route::prefix('{user}')->group(function () {
        Route::post('/patient/create', [ApiPatientController::class, 'create'])->name('api.v1.patient.create');
        Route::patch('/patient/update/{patient}', [ApiPatientController::class, 'update'])->name('api.v1.patient.update');
        Route::patch('/image/update/{patient}/{image}', [ApiImageController::class, 'updateImagePatient'])->name('api.v1.image.patient.update');
    });

    Route::prefix('{user}')->group(function () {
        Route::post('/order/create', [ApiOrderController::class, 'create'])->name('api.v1.order.create');
        Route::post('/order/create/{id}', [ApiOrderController::class, 'createItem'])->name('api.v1.order.createItem');
        Route::patch('/order/update/{order}', [ApiOrderController::class, 'update'])->name('api.v1.order.update');
    });
});

Route::prefix('/v1/page')->group(function () {
    Route::post('/price/send', [ApiPageController::class, 'sendPrice'])->name('api.v1.price.create');
    Route::post('/prothesis/send', [ApiPageController::class, 'sendProthesis'])->name('api.v1.prothesis.create');
});


