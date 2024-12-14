<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PackageUser extends Model
{
    use HasFactory;

    protected $table ="package_users";
    protected $fillable = [
        "package_id",
        "user_id",
        "start_at",
        "expire_at",
        "created_by_id",
        "updated_by_id",
        "deleted_by_id",
        "created_at",
        "updated_at"
    ];

    public function usage() : HasOne{

        return $this->hasOne(PackageUserUsage::class);
    }
}
