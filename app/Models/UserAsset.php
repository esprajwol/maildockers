<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAsset extends Model
{
    use HasFactory;

    protected $table = "user_assets";
    protected $fillable = [
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
        "image_path"
    ];

    public function user() : BelongsTo{
        return $this->belongsTo(User::class);
    }
}
