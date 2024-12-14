<?php

namespace App\Traits\Global;

trait StatusTrait
{

    public function scopeIsActive($query, $isActive = 1)
    {

        return $query->where('status', $isActive);
    }
}
