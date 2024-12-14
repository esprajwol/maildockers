<?php

namespace App\Services\Models\DistrackModel;

use App\Models\DistrackModel;
use App\Models\Partner;
use App\Models\User;
use App\Traits\File\FileUploadTrait;
use Illuminate\Support\Facades\Storage;

class DistrackModelService
{
    use FileUploadTrait;

    public function getAll(
        $isPaginateOrGet = false
    )
    {
        if(isDistributor()){
            $query = DistrackModel::query()->with(["distributor"])->where('distributor_id', \user()->distributor->id)->latest();
        }
        if(isAdmin()){
            $query = DistrackModel::query()->with(["distributor"])->latest();

        }

        return $isPaginateOrGet ? $query->paginate(maxPaginateNo()) : $query->get();
    }
    /**
     * @incomingParams $data received validated and merged data
     * */
    public function store(array $data){
        $request = request();

        // check user photo is selected
        if($request->hasFile("image")){
           $data["image"] = $this->uploadFile($request->file("image"), $this->getModelDirName());
        }

        // User Creation
        $distrackModel = DistrackModel::query()->create($data);

        // Partner Creation
        //$partner = $user->partner()->create($data);

        $serialNo = serialNoGenerator($distrackModel->id, false);

        $distrackModel->update([
            "last_serial_no" => $serialNo
        ]);

        return $distrackModel;
    }

    public function getModelDirName()
    {
        return fileService()::DIR_MODEL."/user_id_".userId();
    }

    public function update(object $distrackModel, array $data) : object
    {
        $request = request();

        // check user photo is selected
        if($request->hasFile("image")){
            $previousImagePath = public_path($distrackModel->image);
            //dd($previousImagePath);
            // $data["photo"] = $this->uploadFile($request->file("photo"), fileService()::DIR_PARTNER_IMAGE);
            $data["image"] = $this->uploadFile($request->file("image"), $this->getModelDirName());
            // Delete the previous image if it exists
            if ($previousImagePath && file_exists($previousImagePath)) {
                unlink($previousImagePath);
            }

        }


        //Update User Creation
        $distrackModel->update($data);

        return $distrackModel;
    }

    public function getDistributorByUserId($user_id, $isFirst = false, string | array $withRelationships = [])
    {
        $query = DistrackModel::query()->where("distributor_id", $user_id);

        (!empty($withRelationships) ? $query->with($withRelationships) : $query);

        return $isFirst ? $query->firstOrFail() : $query->exists();
    }


}
