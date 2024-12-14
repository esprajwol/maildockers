<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;
    protected $table = 'countries';
    protected $fillable = [
        "name",
        "code",
        "flag",
    ];

    public function states() : HasMany
    {
        return $this->hasMany(State::class);
    }
    public function users()
    {
        return $this->hasMany(User::class); 

    }
}
