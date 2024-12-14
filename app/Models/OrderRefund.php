<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderRefund extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'partner_id',
    ];

    protected static function booted()
    {
        static::created(function ($refund) {
            // Automatically create a status entry with 'requested'
            OrderRefundStatus::create([
                'order_refund_id' => $refund->id,
                'status' => OrderRefundStatus::STATUS_REQUESTED,
            ]);
        });
    }

    public function statuses()
    {
        return $this->hasMany(OrderRefundStatus::class);
    }

    public function latestStatus()
    {
        return $this->hasOne(OrderRefundStatus::class)->latestOfMany();
    }

    public static function getAllStatus()
    {
        return [
            OrderRefundStatus::STATUS_REQUESTED,
            OrderRefundStatus::STATUS_PROCESSING,
            OrderRefundStatus::STATUS_COMPLETED,
            OrderRefundStatus::STATUS_FAILED,
        ];
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
