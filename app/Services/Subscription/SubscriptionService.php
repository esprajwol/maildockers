<?php

namespace App\Services\Subscription;

use App\Models\User;

class SubscriptionService
{
    const DEDUCT_MODEL = 1;
    const DEDUCT_USER  = 2;
    const DEDUCT_PRODUCT  = 3;
    /**
     * @incomingParams $balanceDeduct will receive 1/2/3/4 ... 
     * 
     * Here $balanceDeduct == 1 means Model No update. 
     * Here $balanceDeduct == 2 means total users.
     * */ 
    public function updateUserPackageBalance($balanceDeduct = 1, $deductAmount = 1){
        
        $user  =  $this->getSessionUser();

        // Retrieve Active Package 
        $userPackage = $user->activePlan;
        $isExpired   = isExpired($userPackage->expire_at);
        
        if(!$isExpired){
            throw new \Exception("Your package has been expired.");
        }

        $userAsset = $user->userAsset;


        $appStatic = appStatic();
        return match($balanceDeduct){
            self::DEDUCT_USER => $this->deductUser($userAsset, $deductAmount),
            self::DEDUCT_USER => $this->deductUser($userAsset, $deductAmount),
            self::DEDUCT_PRODUCT => $this->deductProduct($userAsset, $deductAmount),
        };
    }


    public function deductProduct(object $userAsset, $deductAmount){
        
        $userAsset->update([
            "total_users" => ($userAsset->total_users + $deductAmount)
        ]);        

        return $userAsset;
    }


    

    public function deductUser(object $userAsset, $deductAmount){
        
        $userAsset->update([
            "total_users" => ($userAsset->total_users + $deductAmount)
        ]);        

        return $userAsset;
    }

    /**
     * Deduct Model Number from use
     * 
    */
    public function deductModel(object $userAsset, $deductAmount){
        $userAsset->update([
            "total_models" => ($userAsset->total_models + $deductAmount)
        ]);        

        return $userAsset;
    }


    public function validityCheckerForProduct($requestQty){

        $userPackage = $this->userActivePlan();

        // already used amount + new request qty == total cost. 
        // total cost should be less than or equal with current package plan limit 
        $user              = $this->getSessionUser();
        $total_cost        = $user->userAsset->total_products + $requestQty;
        $product_max_limit = $userPackage->usage->total_products;
        
        return $product_max_limit>= $total_cost;
    }

    
    public function validityCheckerForModel($requestQty){

        $userPackage = $this->userActivePlan();

        // already used amount + new request qty == total cost. 
        // total cost should be less than or equal with current package plan limit 
        $user              = $this->getSessionUser();
        $total_cost        = $user->userAsset->total_models + $requestQty;
        $product_max_limit = $userPackage->usage->total_models;
        
        return $product_max_limit>= $total_cost;
    }


    public function getSessionUser(){
        $balance_user_id = session("balance_user_id");
        
        return findById(new User(), $balance_user_id);
    }


    public function userActivePlan(){

       $user = $this->getSessionUser();

        // Retrieve Active Package 
        $userPackage = $user->activePlan;
        $isExpired   = isExpired($userPackage->expire_at);
        
        if(!$isExpired){
            throw new \Exception("Your package has been expired.");
        }

        return $userPackage;
    }

}