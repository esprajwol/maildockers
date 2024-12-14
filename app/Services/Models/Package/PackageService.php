<?php

namespace App\Services\Models\Package;

use App\Models\Package;
use App\Models\PackageUserUsage;
use App\Models\PurchasePackage;

class PackageService
{

    public function getPackageById($id)
    {

        return Package::query()->findOrFail($id);
    }

    public function findByColumns($columns = [], $isFirst = true)
    {
        $query = Package::query()->where([$columns]);

        return $isFirst ? $query->firstOrFail() : $query->get();
    }


    public function myPackages(
        $isPaginateOrGet = false, $userId
    )
    {
        $query = PackageUserUsage::query()->with(["package","packageUser"])->where('user_id', $userId)->latest();

        return $isPaginateOrGet ? $query->paginate(maxPaginateNo()) : $query->get();
    }
}
