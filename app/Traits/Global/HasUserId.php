<?php

namespace App\Traits\Global;

trait HasUserId
{
    protected static function bootHasUuid()
    {
        static::creating(function ($model) {
            // Generate a UUID if not already set
            if (!$model->user_id) {
                $model->user_id = userId();
            }
        });

        static::updating(function ($model) {
            // Generate a UUID if not already set
            if (!$model->user_id) {
                $model->user_id = userId();
            }
        });
    }
}
