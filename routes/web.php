<?php

use App\Http\Controllers\Front\AuthController;
use App\Http\Controllers\Front\MainController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

    Route::get('/', [MainController::class, 'home'])->name('front.index');
    Route::get('/about', [MainController::class, 'about'])->name('front.about');
    Route::get('/contacts', [MainController::class, 'contacts'])->name('front.contacts');
    Route::get('/donations', [MainController::class, 'donations'])->name('front.donations');
    Route::post('/setfav', [MainController::class, 'toggleFav'])->name('front.setfav');
    Route::post('/save-contacts', [MainController::class, 'saveContacts'])->name('front.save-contacts');
    Route::post('/logOut', [AuthController::class, 'logOut'])->name('front.logOut');
    Route::get('/posts', [MainController::class, 'posts'])->name('front.posts');
    Route::get('/post/{id}/show', [MainController::class, 'post'])->name('front.post');
    Route::get('/donation/{id}/show', [MainController::class, 'donation'])->name('front.donation');//or here without show its unesseccary
    Route::get('/signup', [AuthController::class, 'register'])->name('front.register');
    Route::post('/registerSave', [AuthController::class, 'registerSave'])->name('front.registerSave');
    Route::get('/signin', [AuthController::class, 'signin'])->name('front.signin');
    Route::post('signin', [AuthController::class, 'login'])->name('front.login');



 //   Route::post('/register', [MainController::class, 'register'])->name('front.register');




Auth::routes();

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DonationRequestController;
use App\Http\Controllers\GovernorateController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\URL;

Route::middleware(['auth', 'auto-check-permission'])->prefix('admin')->group(function () {
    Route::resource('governorate', GovernorateController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('city', CityController::class);
    Route::resource('post', PostController::class);
    Route::resource('role', RoleController::class);
    Route::resource('user', UserController::class);
    // Route::resource('contact', ContactController::class);
    Route::get('/client', [ClientController::class, 'index'])->name('client.index');
    Route::get('/settings/edit', [SettingController::class, 'edit'])->name('settings.edit');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::get('/donation', [DonationRequestController::class, 'index'])->name('donation.index');
    Route::put('/client/{client}/toggle-active', [ClientController::class, 'toggleActive'])->name('client.toggle-active');
    Route::put('/settings/update', [SettingController::class, 'update'])->name('settings.update');
    Route::delete('/client/{id}/destroy', [ClientController::class, 'destroy'])->name('client.destroy');
    Route::delete('/contact/{id}/destroy', [ContactController::class, 'destroy'])->name('contact.destroy');
    Route::delete('/donation/{id}/destroy', [DonationRequestController::class, 'destroy'])->name('donation.destroy');
    Route::get('/donation/{id}/show', [DonationRequestController::class, 'show'])->name('donation.show');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

});

Route::middleware('front')->group(function () {


});


