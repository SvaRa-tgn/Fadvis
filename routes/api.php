<?php

use App\Http\Controllers\API\Admin\Category\ApiCategoryController;
use App\Http\Controllers\API\Admin\Color\ApiColorController;
use App\Http\Controllers\API\Admin\Product\ApiImageController;
use App\Http\Controllers\API\Admin\Product\ApiProductController;
use App\Http\Controllers\API\Admin\User\ApiUserController;
use App\Http\Controllers\API\Page\ApiPageController;
use App\Http\Controllers\API\Pdf\ApiPdfController;
use App\Http\Controllers\API\Profile\ApiPatientController;
use App\Http\Controllers\API\Profile\Order\ApiOrderController;
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
Route::post(
    uri: '/new-password',
    action: [NewPasswordController::class, 'newPassword'],
)->middleware('guest')->name('api.v1.new.password');

Route::prefix('/v1/admin')->middleware('auth:sanctum')->group(function () {
    Route::prefix('/master')->group(function () {
        Route::put('/update/{user}', [ApiUserController::class, 'update'])->name('api.v1.admin.update');
    });

    Route::prefix('/user')->group(function () {
        Route::post('/create', [ApiUserController::class, 'create'])->name('api.v1.user.create');
        Route::patch('/update/{user}', [ApiUserController::class, 'update'])->name('api.v1.user.update');
        Route::put('/change-password/{user}', [ApiUserController::class, 'changePassword'])->name('api.v1.user.changePassword');
    });

    Route::prefix('/category')->group(function () {
        Route::post('/create', [ApiCategoryController::class, 'create'])->name('api.v1.category.create');
        Route::patch('/update/{category}', [ApiCategoryController::class, 'update'])->name('api.v1.category.update');
    });

    Route::prefix('/color')->group(function () {
        Route::post('/create', [ApiColorController::class, 'create'])->name('api.v1.color.create');
        Route::patch('/update/{color}', [ApiColorController::class, 'update'])->name('api.v1.color.update');
    });

    Route::prefix('/product')->group(function () {
        Route::post('/create', [ApiProductController::class, 'create'])->name('api.v1.product.create');
        Route::patch('/update/{product}', [ApiProductController::class, 'update'])->name('api.v1.product.update');
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
        Route::post('/order/{patient}/create', [ApiOrderController::class, 'create'])->name('api.v1.order.create');
    });
});

Route::prefix('/v1/pdf')->middleware('auth:sanctum')->group(function () {
    Route::get('/{order}/download', [ApiPdfController::class, 'download'])->name('api.v1.order.pdf.download');
    Route::post('/{order}/resend', [ApiPdfController::class, 'resend'])->name('api.v1.order.pdf.resend');
});

Route::prefix('/v1/page')->group(function () {
    Route::post('/price/send', [ApiPageController::class, 'sendPrice'])->name('api.v1.price.create');
    Route::post('/prothesis/send', [ApiPageController::class, 'sendProthesis'])->name('api.v1.prothesis.create');
});


