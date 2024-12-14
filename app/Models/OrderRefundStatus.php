<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderRefundStatus extends Model
{
    use HasFactory;

    const STATUS_REQUESTED = 'Requested';
    const STATUS_PROCESSING = 'Processing';
    const STATUS_COMPLETED = 'Completed';
    const STATUS_FAILED = 'Failed';

    protected $fillable = [
        'order_refund_id',
        'status',
    ];

    public function refund()
    {
        return $this->belongsTo(OrderRefund::class);
    }
}
