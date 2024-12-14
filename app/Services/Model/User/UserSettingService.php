<?php

namespace App\Services\Model\User;

use App\Models\UserSetting;

class UserSettingService
{
    public function store(array $data){
        $request = request();
        //dd($request->files);
        // feature Creation
        if(UserSetting::where('user_id',user()->id)->exists()){
           // dd($user);
            $userSetting = UserSetting::query()->where('user_id',user()->id)->update($data);
            return $userSetting;
        }
        $userSetting = UserSetting::query()->create($data);
        return $userSetting;
    }
}
