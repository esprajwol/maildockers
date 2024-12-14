<?php

namespace App\Http\Controllers\Web;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;
class JobProgressController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }
    public function getProgress($orderId)
    {
        $progress = Redis::get("job_progress_{$orderId}");
        if ($progress) {
            return response()->json(json_decode($progress, true));
        } else {
            return response()->json(['status' => 'unknown', 'progress' => 0]);
        }
    }
}
