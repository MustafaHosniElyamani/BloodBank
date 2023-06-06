<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Routing\RouteGroup;


Route::get('/login-client', function () {
return "<h1>hello<h1>";
})->name('login-client');



Route::prefix('v1')->group(function () {
    Route::get('governorates', [MainController::class, 'governorates']);
    Route::get('cities', [MainController::class, 'cities']);
    Route::get('blood-types', [MainController::class, 'bloodTypes']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('forget', [AuthController::class, 'forget']);
    Route::post('set-new-password', [AuthController::class, 'setNewPassword']);
    Route::get('posts', [MainController::class, 'posts']);
    Route::get('post', [MainController::class, 'postDetails']);
    Route::get('categories', [MainController::class, 'categories']);

    Route::middleware(['auth:api'])->group(function () {
        Route::post('set-fav', [MainController::class, 'setFav']);
        Route::post('create-donation', [MainController::class, 'createDonation']);
        Route::get('get-fav', [MainController::class, 'getFav']);
        Route::get('get-not', [MainController::class, 'getNotifications']);
        Route::post('contacts', [MainController::class, 'contacts']);
        Route::get('settings', [MainController::class, 'settings']);
        Route::get('notification-settings', [MainController::class, 'getNotificationSettings']);
        Route::put('notification-settings', [MainController::class, 'updateNotificationSettings']);
        Route::put('edit-profile', [MainController::class, 'editProfile']);

    });

});

