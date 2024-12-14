<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Language extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', "is_active", "direction"];

    public $timestamps = false;

    public function localizations(): HasMany
    {
        return $this->hasMany(Localization::class);
    }
}
