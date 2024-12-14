<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PackageUserUsage extends Model
{
    use HasFactory;

    protected $table = "package_user_usages";
    protected $fillable = [
        "package_id",
        "package_user_id",
        "user_id",
        "total_products",
        "total_users",
        "total_models",
        "anti_fake_detection",
        "create_import_qr",
        "fake_detection_alert",
        "product_sold_alert",
        "out_stock_notifications",
        "permissions_system",
        "advanced_analytics_system",
        "stores_listing",
        "managers_dashboard",
        "unlimited_lotteries",
        "consumers_database_collector",
        "ordering",
        "image_path",
        "is_active",
        "created_by_id",
        "updated_by_id",
        "deleted_by_id",
        "deleted_at"
    ];

    public function package() : BelongsTo
    {
        return $this->belongsTo(Package::class, "package_id");
    }

    public function packageUser() : BelongsTo
    {
        return $this->belongsTo(PackageUser::class, "package_user_id");
    }

    public function getPurchase($user_id, $package_id)
    {
        return PurchasePackage::query()->where("user_id", $user_id)->where("package_id", $package_id)->firstOrFail();
    }

}
