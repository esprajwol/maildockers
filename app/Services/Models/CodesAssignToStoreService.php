<?php

namespace App\Services\Models;

use App\Models\Code;
use App\Models\Series;
use App\Models\SeriesStore;
use App\Traits\File\FileUploadTrait;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CodesAssignToStoreService
{
    use FileUploadTrait;

    public function getAll(
        $isPaginateOrGet = false,
        /*string | array*/ $withRelationship = []
    )
    {
        /*$query2 = SeriesStore::query();

        // Relationship Bind
        !empty($withRelationship) ? $query2->with($withRelationship) : $query2;
                $query = $query2->get()->sortBy('series.id');
                return $query;*/
        if(isDistributor()){
            $query = SeriesStore::query()->where('distributor_id', \user()->distributor->id);
        }else{
            $query = SeriesStore::query();
        }

        // Relationship Bind
        !empty($withRelationship) ? $query->with($withRelationship) : $query;
        return $isPaginateOrGet ? $query->paginate(maxPaginateNo()) : $query->get();
    }


public function store(array $data){
    //dd($data);

   // $request = request();

    // check user photo is selected
    /*if($request->hasFile("image")){
        $data["image"] = $this->uploadFile($request->file("image"), $this->getModelDirName());
    }*/


    // assign Creation
    $assignSeriesToStore = SeriesStore::query()->create($data);

    // update Codes Store
    $startingSerialNo = (int)$data['starting_serial_no']; // Convert to integer
    $endingSerialNo = (int)$data['ending_serial_no']; // Convert to integer

    $codes = Code::whereRaw("CAST(security_no AS UNSIGNED) BETWEEN $startingSerialNo AND $endingSerialNo")
        ->where('series_id', $data['series_id'])
        ->get();
    //dd($codes);
    foreach ($codes as $code){
        //dd($code);
        $code->store_id = $data['store_id'];
        $code->update();
    }

    //dd($assignSeriesToStore);


    return $assignSeriesToStore;
}


    // store QR Code Based on Series
    public function generateQRCodeBasedOnSeries(object $series)
    {
        $model = $series->model;

        //TODO:: Need to create another method to perform the action.
        // Updating Last Serial Number of the Model

        $lastSerialNumber = $model->last_serial_no;

        // Update Start & End Serial Number at Series
        $this->updateSeriesStartEndSerialNoAndSeriesBudget($series, $model);


        $model->update([
            "last_serial_no" => (int) $model->last_serial_no + (int) $series->quantity
        ]);

        // QR Code
        $this->generateSeriesModelCodes($series, $model, $lastSerialNumber);

        return $series;
    }

    public function generateSeriesModelCodes(object $series, object $model, $lastSerialNumber)
    {
        for($start = 1; $start<= $series->quantity; $start++){
            $securityNo = $series->ending_serial_no;

            $nextSerialNumber      = $lastSerialNumber + 1;
            $lastSerialNumber      = $nextSerialNumber;
            $formattedSerialNumber = serialNoGenerator($nextSerialNumber, true);

            $fileName = $formattedSerialNumber.".svg";

            $finalDir = fileService()::DIR_QR."/user_id_".userId();
            $dirCreate = $this->dynamicDirCreate($finalDir);

            $filePath = $finalDir."/".$fileName;


            $code = Code::query()->create([
                "user_id"     => $series->user_id,
                "model_id"    => $series->model_id,
                "series_id"   => $series->id,
                "security_no" => $nextSerialNumber,
                "qr_path"     => $filePath
            ]);

            $url = user()->username.".".getAppUrl()."/{$model->slug}/{$securityNo}";

            // QR Code Saving
            QrCode::generate($url,$filePath);
        }

        return $series;
    }


    public function updateSeriesStartEndSerialNoAndSeriesBudget(object $series, object $model)
    {
        $series->update([
            "unit_price"         => $model->retail_price,
            "total_price"        => getSubTotal($model->retail_price, $series->quantity),
            "starting_serial_no" => (int) $model->last_serial_no + 1,
            "ending_serial_no"   => (int) $model->last_serial_no + (int) $series->quantity,
        ]);

        return $series;

    }

    public function findById($id)
    {
        return SeriesStore::query()->findOrFail($id);
    }
}
