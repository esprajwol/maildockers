<?php

namespace App\Models;

use App\Traits\Global\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchasePackage extends Model
{
    use HasFactory;
    use HasUuid;

    protected $table = "purchase_packages";
    protected $fillable = [
        "uuid",
        "user_id",
        "package_id",
        "amount",
        "paid_at",
        "paid_status",
        "transaction_id",
        "payment_method",
        "payment_response",
        "is_active",
        "created_by_id",
        "updated_by_id",
        "deleted_by_id",
        "deleted_at"
    ];

    public function package() : BelongsTo
    {
        return $this->belongsTo(Package::class, "package_id", "id");
    }
}
