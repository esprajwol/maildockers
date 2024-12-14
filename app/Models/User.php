<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\Global\IsActiveTrait;
use App\Traits\Models\User\UserTypTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use IsActiveTrait;
    use UserTypTrait;
    //    use Billable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "mobile_no",
        "stripe_id",
        "otp",
        "parent_user_id",
        "menu_permission_version",
        "package_id",
        "first_name",
        "middle_name",
        "last_name",
        "username",
        "user_type",
        "photo",
        "email",
        "password",
        "email_verified_at",
        "remember_token",
        "is_active",
        'country_id',
        'state_id',
        'timezone',
        'sub_domain_prefix',
        'company_email',
        'company_name',
        'company_no',
        'company_website',
        'company_address',
    ];

    public function getFullNameAttribute()
    {
        return "$this->first_name $this->middle_name $this->last_name";
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relationships
     * */
    public function partner(): HasOne
    {
        return $this->hasOne(Partner::class, "user_id");
    }
    public function parentUser()
    {
        return $this->belongsTo(User::class, "parent_user_id");
    }

    public function distributor(): HasOne
    {
        return $this->hasOne(Distributor::class, "user_id");
    }
    public function package()
    {
        return $this->belongsTo(Package::class, "package_id");
    }

    public function packageUserUsages(): HasMany
    {
        return $this->hasMany(PackageUserUsage::class, "user_id")->with("package");
    }

    public function activePlan()
    {
        return $this->hasOne(PackageUser::class)->latest("id");
    }

    public function userAsset(): HasOne
    {
        return $this->hasOne(UserAsset::class);
    }

    public function setting()
    {
        return $this->hasOne(UserSetting::class);
    }

    public function serieses(): HasMany
    {
        return $this->hasMany(Series::class, "user_id");
    }
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

}
