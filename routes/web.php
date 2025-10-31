<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DangerousAccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\AuthenticateAdmin;

Route::get('/report', [DangerousAccountController::class, 'create'])->name('dangerous.create');
Route::post('/report', [DangerousAccountController::class, 'store'])->name('dangerous.store');

Route::get('/cek-id', [DangerousAccountController::class, 'cekIdForm'])->name('dangerous.cekIdForm');
Route::post('/cek-id', [DangerousAccountController::class, 'cekIdSubmit'])->name('dangerous.cekIdSubmit');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/kasus', [App\Http\Controllers\DangerousAccountController::class, 'index'])->name('dangerous.index');
Route::get('/kasus/{id}', [App\Http\Controllers\DangerousAccountController::class, 'show'])->name('dangerous.show');

Route::post('/admin/dangerous_accounts/{id}/accept', [App\Http\Controllers\DangerousAccountController::class, 'adminAccept'])->name('admin.dangerous_accounts.accept');

Route::get('/contacts', [App\Http\Controllers\HomeController::class, 'contacts'])->name('contacts');

// Admin login routes
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

// Admin register routes
Route::get('/admin/637d4f870d9f555f14ecb49ae5a5a01d', [LoginController::class, 'showRegisterForm'])->name('admin.register');
Route::post('/admin/637d4f870d9f555f14ecb49ae5a5a01d', [LoginController::class, 'register'])->name('admin.register.submit');

// Admin dashboard route protected by middleware
Route::middleware([AuthenticateAdmin::class])->group(function () {

    // Admin routes for dangerous accounts management
    Route::prefix('admin/dangerous-accounts')->name('admin.dangerous_accounts.')->group(function () {
        Route::get('/', [DangerousAccountController::class, 'adminIndex'])->name('index');
        Route::get('/create', [DangerousAccountController::class, 'adminCreate'])->name('create');
        Route::post('/', [DangerousAccountController::class, 'adminStore'])->name('store');
        Route::get('/{id}/edit', [DangerousAccountController::class, 'adminEdit'])->name('edit');
        Route::put('/{id}', [DangerousAccountController::class, 'adminUpdate'])->name('update');
        Route::delete('/{id}', [DangerousAccountController::class, 'adminDestroy'])->name('destroy');
    });

    // Admin routes for dangerous phone numbers management
    Route::prefix('admin/dangerous-phone-numbers')->name('admin.dangerous_phone_numbers.')->group(function () {
        Route::get('/', [App\Http\Controllers\DangerousPhoneNumberController::class, 'adminIndex'])->name('index');
        Route::get('/create', [App\Http\Controllers\DangerousPhoneNumberController::class, 'adminCreate'])->name('create');
        Route::post('/', [App\Http\Controllers\DangerousPhoneNumberController::class, 'adminStore'])->name('store');
        Route::get('/{id}/edit', [App\Http\Controllers\DangerousPhoneNumberController::class, 'adminEdit'])->name('edit');
        Route::put('/{id}', [App\Http\Controllers\DangerousPhoneNumberController::class, 'adminUpdate'])->name('update');
        Route::delete('/{id}', [App\Http\Controllers\DangerousPhoneNumberController::class, 'adminDestroy'])->name('destroy');
    });

    // Admin routes for grup jual beli cards management
    Route::prefix('admin/grup-jual-beli-cards')->name('admin.grup_jual_beli_cards.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\GrupJualBeliCardController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\Admin\GrupJualBeliCardController::class, 'create'])->name('create');
        Route::post('/', [App\Http\Controllers\Admin\GrupJualBeliCardController::class, 'store'])->name('store');
        Route::post('/reorder', [App\Http\Controllers\Admin\GrupJualBeliCardController::class, 'reorder'])->name('reorder');
        Route::get('/{grupJualBeliCard}/edit', [App\Http\Controllers\Admin\GrupJualBeliCardController::class, 'edit'])->name('edit');
        Route::put('/{grupJualBeliCard}', [App\Http\Controllers\Admin\GrupJualBeliCardController::class, 'update'])->name('update');
        Route::delete('/{grupJualBeliCard}', [App\Http\Controllers\Admin\GrupJualBeliCardController::class, 'destroy'])->name('destroy');
        Route::get('/{grupJualBeliCard}/move-up', [App\Http\Controllers\Admin\GrupJualBeliCardController::class, 'moveUp'])->name('moveUp');
        Route::get('/{grupJualBeliCard}/move-down', [App\Http\Controllers\Admin\GrupJualBeliCardController::class, 'moveDown'])->name('moveDown');
    });

    // Admin routes for contact us cards management
    Route::prefix('admin/contact-us-cards')->name('admin.contact_us_cards.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\ContactUsCardController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\Admin\ContactUsCardController::class, 'create'])->name('create');
        Route::post('/', [App\Http\Controllers\Admin\ContactUsCardController::class, 'store'])->name('store');
        Route::post('/reorder', [App\Http\Controllers\Admin\ContactUsCardController::class, 'reorder'])->name('reorder');
        Route::get('/{contactUsCard}/edit', [App\Http\Controllers\Admin\ContactUsCardController::class, 'edit'])->name('edit');
        Route::put('/{contactUsCard}', [App\Http\Controllers\Admin\ContactUsCardController::class, 'update'])->name('update');
        Route::delete('/{contactUsCard}', [App\Http\Controllers\Admin\ContactUsCardController::class, 'destroy'])->name('destroy');
        Route::get('/{contactUsCard}/move-up', [App\Http\Controllers\Admin\ContactUsCardController::class, 'moveUp'])->name('moveUp');
        Route::get('/{contactUsCard}/move-down', [App\Http\Controllers\Admin\ContactUsCardController::class, 'moveDown'])->name('moveDown');
    });
});

use Illuminate\Http\Request;

// User route for dangerous phone number search
Route::post('/search-ml-id', [App\Http\Controllers\HomeController::class, 'searchMlId'])->name('search.ml_id');

Route::match(['get', 'post'], '/dangerous-phone-numbers/search', [App\Http\Controllers\DangerousPhoneNumberController::class, 'userSearch'])->name('dangerous_phone_numbers.search');

Route::get('/rekber', function () {
    return view('rekber');
})->name('rekber');
Route::view('/peraturan-rekber', 'peraturan')->name('peraturan');

Route::view('/cara-rekber', 'cara')->name('cara');
