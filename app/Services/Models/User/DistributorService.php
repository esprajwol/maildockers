<?php

namespace App\Services\Models\User;

use App\Models\User;

class DistributorService
{
    public function getAll(
        $isPaginateOrGet = false,
        $isActiveOnly = null,
        string | array $withRelationships = []
    )
    {
        $query = User::query()->userType(appStatic()::TYPE_DISTRIBUTOR)->whereHas("distributor")->latest();

        // Bind With Relationships
        (!is_null($withRelationships) ? $query->with($withRelationships) : $query);

        if (is_null($isPaginateOrGet)) {
            return $query->pluck("first_name", "id");
        }

        return $isPaginateOrGet ? $query->paginate(maxPaginateNo()) : $query->get();
    }
}
