<?php

namespace App\Services\Models\Distributor\DistributorStaff;

use App\Models\Distributor;
use App\Models\User;
use App\Traits\File\FileUploadTrait;
use App\Utils\AppStatic;

class DistributorStaffService
{
    use FileUploadTrait;

    public function getAll(
        $isPaginateOrGet = false,
        $isActiveOnly = null
        /*string | array $withRelationships = []*/
    )
    {
       // dd(\user());
        $query = User::query()->userType(AppStatic::TYPE_DISTRIBUTOR_STAFF)->where('parent_user_id',\user()->id)->latest();

        return $isPaginateOrGet ? $query->paginate(maxPaginateNo()) : $query->get();
    }
    /**
     * @incomingParams $data received validated and merged data
     * */
    public function store(array $data){
        $request = request();

        // check user photo is selected
        if($request->hasFile("photo")){
            $data["photo"] = $this->uploadFile($request->file("photo"), fileService()::DIR_DISTRIBUTOR_IMAGE);
        }

        // User Creation
        $user = User::query()->create($data);

        // Partner Creation
        //$partner = $user->partner()->create($data);


        return $user;
    }

    public function update(object $user, array $data) : object
    {
        //dd($user);
        $request = request();

        // check user photo is selected
        if($request->hasFile("photo")){
            //dd('hi');
            if(isset($user->photo)){
                $previousImagePath = public_path($user->photo);
            }
            //dd($previousImagePath);
            // $data["photo"] = $this->uploadFile($request->file("photo"), fileService()::DIR_PARTNER_IMAGE);
            $data["photo"] = $this->uploadFile($request->file("photo"), fileService()::DIR_DISTRIBUTOR_IMAGE);
            // Delete the previous image if it exists
            if(isset($previousImagePath)){
                if($previousImagePath && file_exists($previousImagePath)) {
                    unlink($previousImagePath);
                }
            }


        }


        //Update User Creation
        $user->update($data);

        return $user;
    }
    public function createUserAccount(array $payloads)
    {
        return User::query()->create($payloads);
    }


    public function createDistributorProfile(object $user, array $payloads)
    {
        //TODO:: File will upload here

        return $user->distributor()->create($payloads);
    }
}
