<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "stripe_product_id",
        "stripe_plan",
        "name",
        "price",
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
        "is_active",
    ];

}
