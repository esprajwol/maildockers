<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserSettingStoreRequest;
use App\Models\UserSetting;
use App\Services\Model\User\UserSettingService;
use Illuminate\Http\Request;

class UserSettingController extends Controller
{
   public function create(){
       $data['userSetting'] = UserSetting::where('user_id',userId())->first();
       return view('dashboard.userSettings.add_user_setting')->with($data);
   }
    public function store(UserSettingStoreRequest $request, UserSettingService $userSettingService)
    {
       // dd($request->getData());

        try {
            \DB::beginTransaction();
            $userSetting = $userSettingService->store($request->getData());
            \DB::commit();

            flashMessage("User settings update successfully");
            if(isAdmin()){
                return to_route("admin.user-settings.create");

            }
            if(isDistributor()){
                return to_route("distributor.user-settings.create");

            }
            if(isPartner()){
                return to_route("partner.user-settings.create");

            }
        } catch (\Throwable $e) {
            \DB::rollBack();
            commonLog("Failed to update User setting ", errorArray($e));
            ddError($e);
            return back();
        }
    }
}
