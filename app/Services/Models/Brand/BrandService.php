<?php

namespace App\Services\Models\Brand;

use App\Models\Brand;

class BrandService
{
    public function getAll(
        $isPaginateOrGet = false,
        $activeOnly = null,

    )
    {
        $query = Brand::query();

        // when active only not null
        if(!is_null($activeOnly)){
            $query->isActive($activeOnly);
        }

        // when paginate or get is null means return pluck data
        if(is_null($isPaginateOrGet)){
            return $query->pluck('name', 'id');
        }

        return $isPaginateOrGet ? $query->paginate(maxPaginateNo()) : $query->get();
    }


}
