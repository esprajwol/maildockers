<?php
use App\Http\Controllers\Partner\Dashboard\PartnerDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\User\UserProfileController;
use App\Http\Controllers\Admin\User\UserPasswordResetController;
use App\Http\Controllers\Admin\User\UserSettingController;
use App\Http\Controllers\Partner\Dashboard\PartnerPriceController;

Route::middleware(['auth','timezone'])->group(function () {
    Route::get("/", [PartnerDashboardController::class, "index"])->name("dashboard");
    Route::get("orders", [PartnerDashboardController::class, "orders"])->name("orders");
    Route::get("order-refund-requests", [PartnerDashboardController::class, "order_refund_requests"])->name("order_refund_requests");

    Route::get('profile', [UserProfileController::class, 'userProfile'])->name('user.partner.profile');
    Route::post('profile', [UserProfileController::class, 'userProfileUpdate'])->name('user.profileUpdate');

    Route::get('user/reset-password', [UserPasswordResetController::class, 'userPasswordReset'])->name('userPasswordReset');
    Route::post('user/reset-password', [UserPasswordResetController::class, 'updatePassword'])->name('updatePassword.update');
    Route::resource("user-settings",UserSettingController::class);

    Route::get('prices/edit', [PartnerPriceController::class, 'edit'])->name('prices.edit');
    Route::post('prices/update', [PartnerPriceController::class, 'update'])->name('prices.update');


});
