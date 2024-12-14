<?php

namespace App\Services\Models\PurchasePackage;

use App\Models\PackageUser;
use App\Models\PackageUserUsage;
use App\Models\PurchasePackage;
use App\Services\Models\Package\PackageService;
use App\Services\Models\User\UserService;
use http\Exception\RuntimeException;

class PurchaseService
{
    public function purchasePackage(array $payloads, object $package)
    {
        if(!isLoggedIn()){
            // Distributor Account Create
            $payloads["is_active"] = 0;
            $user = (new UserService())->createUserAccount($payloads);

            // Distributor Profile Create
            $distributor = (new UserService())->createDistributorProfile($user, $payloads);

            auth()->login($user);
        }else{
            if(isDistributor() || isDistributorStaff()){
                $user = user();
            }else{
                throw new \Exception("Sorry! You are not authorized to purchase.");
            }
        }

        // Save Package User Data
        $packageUser = $this->savePackageUserData($user, $package);

        // Place order as Purchase Package
        $purchasePackage = $this->placePackageOrder($user, $package);

        // Package Uses
        $this->savePackageUserUsages($purchasePackage, $packageUser, $package);

        return $user;
    }

    public function placePackageOrder(object $user, object $package)
    {
        $payloads = [
            "user_id" => $user->id,
            "package_id" => $package->id,
            "amount" => $package->price,
            "paid_at" => now(), // TODO Required based on payemnt gateway
            "paid_status" => "paid", // TODO Required based on payemnt gateway
        ];

        return PurchasePackage::query()->create($payloads);
    }


    public function savePackageUserData(object $user, object $package)
    {
        $payloads = [
            "user_id" => $user->id,
            "package_id" => $package->id,
            "start_at" => now(),
            "expire_at" => now()->addDay(30),
        ];

        return PackageUser::query()->create($payloads);
    }

    public function savePackageUserUsages(object $purchasePackage, object $packageUser, object $package)
    {
        $payloads = [
            "package_user_id"               => $packageUser->id,
            "package_id"                    => $package->id,
            "user_id"                       => $purchasePackage->user_id,

            // Package Data Start
            "total_products"                => $package->total_products,
            "total_users"                   => $package->total_users,
            "total_models"                  => $package->total_models,
            "anti_fake_detection"           => $package->anti_fake_detection,
            "create_import_qr"              => $package->create_import_qr,
            "fake_detection_alert"          => $package->fake_detection_alert,
            "product_sold_alert"            => $package->product_sold_alert,
            "out_stock_notifications"       => $package->out_stock_notifications,
            "permissions_system"            => $package->permissions_system,
            "advanced_analytics_system"     => $package->advanced_analytics_system,
            "stores_listing"                => $package->stores_listing,
            "managers_dashboard"            => $package->managers_dashboard,
            "unlimited_lotteries"           => $package->unlimited_lotteries,
            "consumers_database_collector"  => $package->consumers_database_collector,
            "ordering"                      => $package->ordering
            // Package Data End
        ];

        return PackageUserUsage::query()->create($payloads);
    }
}
