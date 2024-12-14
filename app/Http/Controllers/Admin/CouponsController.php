<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CouponsController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $data['coupons'] = Coupon::orderBy('id','desc')->paginate();
        return view('dashboard.version1.coupons.index', $data);
    }

    public function create()
    {
        $coupon = Coupon::create([
            'coupon_no' => strtoupper(Str::random(5)),
            'email'     => "",
            'used_at'   => null
        ]);

        return redirect()->route('admin.coupons.index')->with('success', 'New Coupon Created successfully '.$coupon->coupon_no);
    }
    public function used_coupons(Request $request)
    {
        $data = [];
        $data['coupons'] = Coupon::where('used_at', '!=', null)->paginate();
        return view('dashboard.version1.coupons.used-coupons', $data);
    }


}
