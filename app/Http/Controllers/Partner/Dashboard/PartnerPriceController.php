<?php

namespace App\Http\Controllers\Partner\Dashboard;

use App\Models\PartnerPrice;
use App\Models\Partner;
use App\Models\User;
use App\Services\BenchMark\BenchMarkService;
use App\Services\Chart\ChartService;
use App\Services\Models\User\PartnerService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PartnerPriceUpdateRequest;
use App\Models\Country;
use App\Models\Currency;
use App\Traits\Api\ApiResponseTrait;
use App\Services\Google\OrderMessageService;
use Illuminate\Support\Facades\Auth;

class PartnerPriceController extends Controller
{
    use ApiResponseTrait;
    public function index()
    {

    }
    public function create()
    {

    }
    public function store()
    {

    }
    public function edit(PartnerPrice $partnerPrice)
    {
        $userId = userId();
        $data['currencies'] = Currency::query()->whereNotNull('symbol')->get();
        $data["user"]    = auth()->user();
        $data["partnerPrice"] = PartnerPrice::where('partner_id', $userId)->first();
        $data['countries'] = Country::query()->get();

        return view("dashboard.version1.partners.prices.edit")->with($data);

    }
    public function update(PartnerPriceUpdateRequest $request){

        $userId = userId();
        $currentUser = Auth::user();
        $country = Country::find($currentUser->country_id);
        $currency = Currency::where('country', $country->name)->first();
        $partnerPrice = PartnerPrice::where('partner_id', $userId)->first();
        if($partnerPrice)
        {
        $partnerPrice->partner_id = $userId;

        $partnerPrice->country_code = $country->code;
        $partnerPrice->price = $request->price;
        $partnerPrice->currency_id = $currency->id;
        $partnerPrice->update();

    } else {
        // Create a new PartnerPrice record
        $partnerPrice = new PartnerPrice();
        $partnerPrice->partner_id = $userId;
        $partnerPrice->country_code = $country->code;
        $partnerPrice->price = $request->price;
        $partnerPrice->currency_id = $currency->id;
        $partnerPrice->save();

    }
    return redirect()->back()->with('success', 'Price Updated Successfully');

    }


}
