<?php

namespace App\Http\Controllers\Admin\Partner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DistrackModelStoreRequest;
use App\Http\Requests\Admin\DistrackModelUpdateRequest;
use App\Http\Requests\Admin\PartnerStoreRequest;
use App\Http\Requests\Admin\PartnerUpdateRequest;
use App\Models\Country;
use App\Models\State;
use App\Models\User;
use App\Services\Models\User\PartnerService;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index(Request $request, PartnerService $partnerService)
    {
        $partners = $partnerService->getAll(true);
        return view('dashboard.version1.partners.index', compact('partners'));
    }

    public function create(Request $request)
    {
        $data['countries']  = Country::query()->get();

        return view('dashboard.version1.partners.add_partner')->with($data);
    }

    public function store(PartnerStoreRequest $request, PartnerService $partnerService)
    {
        $input = $request->all();
        $input['user_type'] = 'partner';

        try{
            \DB::beginTransaction();
            $partner = $partnerService->store($input);
            \DB::commit();


            flashMessage("Partner created successfully");

            return to_route("admin.partners.index");
        }
        catch(\Throwable $e){
            \DB::rollBack();
            commonLog("Failed to store partner", errorArray($e));

            ddError($e);

        }
    }

    public function edit(User $partner)
    {
        $data['countries']  = Country::query()->get();
        $data["user"]       = $partner;
        unset($data["user"]->password);

        return view("dashboard.version1.partners.edit_partner")->with($data);
    }

    public function update(PartnerUpdateRequest $request, User $partner, PartnerService $partnerService)
    {
        try{
            \DB::beginTransaction();
            $partner = $partnerService->update($partner, $request->all());
            \DB::commit();


            flashMessage("Partner updated successfully");

            return to_route("admin.partners.index");

        }
        catch(\Throwable $e){
            \DB::rollBack();
            commonLog("Failed to store partner", errorArray($e));

            ddError($e);
        }
    }

    public function destroy(Request $request, User $partner)
    {
        try{

            $partner->delete();

            flashMessage("Partner Account deleted successfully");

            return to_route("admin.partners.index");
        }
        catch(\Throwable $e){
            commonLog("Failed to Delete Partner", errorArray($e));

            ddError($e);
        }
    }
    public function getStateByCountry(Request $request, $country_id)
    {
        return State::where('country_id', $request->country_id)->get();
    }
}
