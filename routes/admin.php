<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Partner\PartnerController;
use App\Http\Controllers\Admin\User\UserProfileController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\User\UserPasswordResetController;
use App\Http\Controllers\Admin\User\UserSettingController;
use App\Http\Controllers\Admin\LocalizationController;
use App\Http\Controllers\Admin\CouponsController;
use App\Http\Controllers\Admin\LanguageController;

Route::get('hello', function () {
    dd(1);
});
Route::middleware(["auth"])->group(function () {

    //Route::group([
    //    'middleware' => ['auth']
    //],function (){

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::prefix("notifications")->name("notifications.")->group(function () {
        Route::get('/', [DashboardController::class, 'notifications'])->name('index');
        Route::post('mark-as-read', [DashboardController::class, 'markNotification'])->name('markAsRead');
    });

    Route::resource("partners", PartnerController::class);

    Route::resource("users", UserController::class);
    Route::resource("user-settings", UserSettingController::class);

    Route::prefix("distributors")->name("distributors.")->group(function () {
        Route::get("/", [DashboardController::class, "allDistributors"])->name("index");
    });
    Route::get('profile', [UserProfileController::class, 'userProfile'])->name('user.admin.profile');
    Route::post('profile/{id}', [UserProfileController::class, 'userProfileUpdate'])->name('user.profileUpdate');

    Route::get('user/reset-password', [UserPasswordResetController::class, 'userPasswordReset'])->name('userPasswordReset');
    Route::post('user/reset-password', [UserPasswordResetController::class, 'updatePassword'])->name('updatePassword.update');
    //Route::post('profile', [UserProfileController::class, 'userProfileUpdate'])->name('user.profileUpdate');


    Route::controller(PackageController::class)->group(function () {
        Route::get('/packages/lists', 'lists')->name('package.lists');
        Route::match(['get', 'post'], '/packages/create', 'create')->name('package.generate');
        Route::match(['get', 'post'], '/packages/update/{id}', 'update')->name('package.update');
        Route::get('/view-package/{packageId}', 'show')->name('package.show');
    });

    Route::resource("languages", LanguageController::class);

    Route::prefix("localizations")->name("localizations.")->group(function () {
        Route::get('localizations', [LocalizationController::class, 'index'])->name('index');
        Route::get('localizations/{localization}/edit', [LocalizationController::class, 'edit'])->name('edit');
        Route::post('localizations/{language_id}', [LocalizationController::class, 'update'])->name('update');
    });

    Route::resource("coupons", CouponsController::class);
    // Route::get("coupons", [CouponsController::class, "index"])->name("coupons.index");
    Route::get("coupons-used", [CouponsController::class, "used_coupons"])->name("coupons.used");
});
