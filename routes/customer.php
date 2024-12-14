<?php
use App\Http\Controllers\Admin\CodeController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\User\UserProfileController;
use App\Http\Controllers\PaymentGateway\StripePaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\User\UserPasswordResetController;
use App\Http\Controllers\Admin\User\UserSettingController;
use App\Http\Controllers\Admin\LotteryController;
use App\Http\Controllers\Customer\CustomerDashboardController;
use App\Http\Controllers\Web\HomeController;


Route::middleware(["auth"])->group(function () {


    Route::get('orders',[CustomerDashboardController::class,'orders'])->name('orders');
    Route::get('order-messages/{orderId}',[CustomerDashboardController::class,'orderMessages'])->name('orderMessages');

    Route::resource("user-settings",UserSettingController::class);

    Route::get("/", [HomeController::class, "index"])->name("dashboard");
//
//    Route::prefix("notifications")->name("notifications.")->group(function(){
//        Route::get('/', [DistributorDashboardController::class, 'notifications'])->name('index');
//        Route::post('mark-as-read', [DistributorDashboardController::class, 'markNotification'])->name('markAsRead');
//    });

    Route::get('profile', [UserProfileController::class, 'userProfile'])->name('user.distributor.profile');
    Route::post('profile', [UserProfileController::class, 'userProfileUpdate'])->name('user.profileUpdate');

    Route::get('user/reset-password', [UserPasswordResetController::class, 'userPasswordReset'])->name('userPasswordReset');
    Route::post('user/reset-password', [UserPasswordResetController::class, 'updatePassword'])->name('updatePassword.update');

    Route::resource("user-settings",UserSettingController::class);


});

