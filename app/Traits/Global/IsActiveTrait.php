<?php

namespace App\Traits\Global;

trait IsActiveTrait
{
    public function scopeIsActive($query, $active = 1)
    {

        return $query->where('is_active', $active);
    }
}
