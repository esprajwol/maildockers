<?php

namespace App\Traits\Global;

use Illuminate\Support\Str;

trait HasUuid
{
    protected static function bootHasUuid()
    {
        static::creating(function ($model) {
            // Generate a UUID if not already set
            if (!$model->uuid) {
                $model->uuid = Str::uuid();
            }
        });
    }

    /**
     * Get the column name for the UUID.
     *
     * @return string
     */
    public function getUuidColumn()
    {
        return 'uuid';
    }
}
