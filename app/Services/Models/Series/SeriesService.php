<?php

namespace App\Services\Models\Series;

use App\Models\Code;
use App\Models\Series;
use App\Traits\File\FileUploadTrait;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SeriesService
{
    use FileUploadTrait;

    public function getAll(
        $isPaginateOrGet = false,
        string | array $withRelationship = []
    ) {
         if(isDistributor()){
                  $query = Series::query()->where('user_id', \user()->id)->latest();

        }else{
         $query = Series::query()->latest();

         }

        // Relationship Bind
        !empty($withRelationship) ? $query->with($withRelationship) : $query;

        return $isPaginateOrGet ? $query->paginate(maxPaginateNo()) : $query->get();
    }

    public function store(array $payloads)
    {
        return Series::query()->create($payloads);
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
            "last_serial_no" => (int) $model->last_serial_no + (int) $series->quantity,
        ]);

        // QR Code
        $this->generateSeriesModelCodes($series, $model, $lastSerialNumber);

        return $series;
    }

    public function generateSeriesModelCodes(object $series, object $model, $lastSerialNumber)
    {
        for ($start = 1; $start <= $series->quantity; $start++) {
            $securityNo = $series->ending_serial_no;

            $nextSerialNumber = $lastSerialNumber + 1;
            $lastSerialNumber = $nextSerialNumber;
            $formattedSerialNumber = serialNoGenerator($nextSerialNumber, true);

            $fileName = $formattedSerialNumber . ".svg";

            $finalDir = fileService()::DIR_QR . "/user_id_" . userId();
            $dirCreate = $this->dynamicDirCreate($finalDir);

            $filePath = $finalDir . "/" . $fileName;

            $code = Code::query()->create([
                "user_id" => $series->user_id,
                "model_id" => $series->model_id,
                "series_id" => $series->id,
                "security_no" => $nextSerialNumber,
                "qr_path" => $filePath,
            ]);

            $url = user()->username . "." . getAppUrl() . "/{$model->slug}/{$securityNo}";

            // QR Code Saving
            QrCode::generate($url, $filePath);
        }

        return $series;
    }

    public function updateSeriesStartEndSerialNoAndSeriesBudget(object $series, object $model)
    {
        $series->update([
            "unit_price" => $model->retail_price,
            "total_price" => getSubTotal($model->retail_price, $series->quantity),
            "starting_serial_no" => (int) $model->last_serial_no + 1,
            "ending_serial_no" => (int) $model->last_serial_no + (int) $series->quantity,
        ]);

        return $series;

    }

    public function findById($id)
    {
        return Series::query()->findOrFail($id);
    }
}
