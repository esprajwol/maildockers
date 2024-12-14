<?php

namespace App\Services\Models\Code;

use App\Models\Code;
use App\Models\Information;
use Carbon\Carbon;
use Stevebauman\Location\Facades\Location;

class CodeService
{
    public function getAll(
        $isPaginateOrGet = false,
        $user_id = null,
        $withRelationship = []
    )
    {
        $query = Code::query()->latest("id");

        // Bind Distributor ID
        if(!is_null($user_id)){
            $query->where("user_id", $user_id);
        }

        // Bind Relationship
        (!empty($withRelationship) ? $query->with($withRelationship) : $query);

        return $isPaginateOrGet ? $query->paginate(maxPaginateNo())->fragment("codes") : $query->get();
    }

    public function findByColumn(array $columns, $isFirst= true){
        $query = Code::query()->where([$columns]);

        return $isFirst ? $query->first() : $query->get();
    }

    public function storeQrCodeScanInformation(object $code)
    {
        //$ip              =  "113.212.111.79";
        $ip              =  request()->ip();
        $currentUserInfo = Location::get($ip); // user location information
        date_default_timezone_set('America/New_York');

        $payloads = [
            "code_id"     => $code->id,
            'currentTime' => now()
        ];

        if ($currentUserInfo) {
            $payloads+=[
                "ip"          => $currentUserInfo->ip,
                "countryName" => $currentUserInfo->countryName,
                "countryCode" => $currentUserInfo->countryCode,
                "regionCode"  => $currentUserInfo->regionCode,
                "regionName"  => $currentUserInfo->regionName,
                "cityName"    => $currentUserInfo->cityName,
                "zipCode"     => $currentUserInfo->zipCode,
                "isoCode"     => $currentUserInfo->isoCode,
                "postalCode"  => $currentUserInfo->postalCode,
                "latitude"    => $currentUserInfo->latitude,
                "longitude"   => $currentUserInfo->longitude,
                "metroCode"   => $currentUserInfo->metroCode,
                "areaCode"    => $currentUserInfo->areaCode,
                "timezone"    => $currentUserInfo->timezone,
            ];
        }

        return Information::query()->create($payloads);
    }

    public function getAllSeries(
        $isPaginateOrGet = false,
        $isStoreIdNull = null,
        array $columns = []
    )
    {
        $query = Code::query()->where([$columns]);

        if(!is_null($isStoreIdNull)){
            if($isStoreIdNull){
                $query->whereNull('store_id');
            }
        }

        return $isPaginateOrGet ? $query->paginate(maxPaginateNo()) : $query->get();
    }

}
