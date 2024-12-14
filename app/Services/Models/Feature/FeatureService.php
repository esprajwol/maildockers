<?php

namespace App\Services\Models\Feature;

use App\Models\DistrackModel;
use App\Models\Feature;
use App\Models\Partner;
use App\Models\User;
use App\Traits\File\FileUploadTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FeatureService
{
    use FileUploadTrait;

    public function getAll(
        $isPaginateOrGet = false,
        $isActiveOnly = null,
    )
    {
        $query = Feature::query()->orderBy('order');
        !empty($isActiveOnly) ? $query->where('is_active',$isActiveOnly) : $query;

        return $isPaginateOrGet ? $query->paginate(maxPaginateNo()) : $query->get();
    }
    /**
     * @incomingParams $data received validated and merged data
     * */
    public function store(array $data){
        $request = request();
        //dd($request->files);


        // check user photo is selected
        if($request->hasFile("feature_image")){
           $data["feature_image"] = $this->uploadFile($request->file("feature_image"), $this->getModelDirName());
        }
        //multiple image upload
        $images = [];
        if($request->hasFile("images")){
            foreach ($request->images as $img){

                $images[] = $this->uploadFile($img, $this->getModelDirName());

            }
        }
        if(!empty($images)){
            $data['images'] = json_encode($images);
        }
        //multiple file upload
       /* $files = [];
        if($request->hasFile("attachments")){
           // dd('hi');

            foreach ($request->attachments as $file){
               // dd($file);
                $files[] = $this->uploadFile($file, $this->getFileDirName(), false);

            }
        }
        //dd($files);
        if(!empty($files)){
            $data['files'] = json_encode($files);
        }*/

        if ($request->documents != null) {
            $files = $request->documents;

            /*$currentDate = Carbon::now()->toDateString();
            $currentDate1 = Carbon::now();
            $formattedDate = $currentDate1->format('FY');

            $fileObjects = [];
            foreach ($files as $file) {
                $fileName = $currentDate . '-' . uniqid() . '.' . $file->getClientOriginalExtension();

                // Ensure the directory exists, if not, create it
                if (!Storage::disk('public')->exists('uploads/features/files/' . $formattedDate)) {
                    Storage::disk('public')->makeDirectory('uploads/features/files/' . $formattedDate);
                }

                // Store the file in the desired directory
                $path = $file->storeAs('uploads/features/files/' . $formattedDate, $fileName, 'public');

                // Create file object for JSON encoding
                $fileObject = [
                    'download_link' => $path,
                    'original_name' => $file->getClientOriginalName(),
                ];
                $fileObjects[] = $fileObject;*/
            $currentDate = now()->toDateString();
            $formattedDate = now()->format('FY');

            $fileObjects = [];
            foreach ($files as $file) {
                $fileName = $currentDate . '-' . uniqid() . '.' . $file->getClientOriginalExtension();

                // Ensure the directory exists, if not, create it
                $directory = public_path('uploads/features/files/' . $formattedDate);
                if (!file_exists($directory)) {
                    mkdir($directory, 0777, true);
                }

                // Move the file to the desired directory
                $path = $file->move($directory, $fileName);

                // Create file object for JSON encoding
                $fileObject = [
                    'download_link' => 'uploads/features/files/' . $formattedDate . '/' . $fileName,
                    'original_name' => $file->getClientOriginalName(),
                ];
                $fileObjects[] = $fileObject;
            }

            // Save the JSON-encoded file objects to your model
            $data['files'] = json_encode($fileObjects);
        }
        // feature Creation
        $feature = Feature::query()->create($data);

        return $feature;
    }

    public function getModelDirName()
    {
        return fileService()::DIR_Feature."/user_id_".userId();
    }
    public function getFileDirName()
    {
        return fileService()::DIR_Feature_File."/user_id_".userId();
    }

    public function update(object $feature, array $data) : object
    {
        $request = request();

        // check user photo is selected
        if($request->hasFile("feature_image")){
            $previousImagePath = public_path($feature->feature_image);
            //dd($previousImagePath);
            // $data["photo"] = $this->uploadFile($request->file("photo"), fileService()::DIR_PARTNER_IMAGE);
            $data["feature_image"] = $this->uploadFile($request->file("feature_image"), $this->getModelDirName());
            // Delete the previous image if it exists
            if ($previousImagePath && file_exists($previousImagePath)) {
                unlink($previousImagePath);
            }

        }
        //upload and delete multiple images
        $images = [];
        if($request->hasFile("images")){
            if(!empty($feature->images)){
                foreach(json_decode($feature->images) as $img){
                    $previousImagePath = public_path($img);
                    if ($previousImagePath && file_exists($previousImagePath)) {
                        unlink($previousImagePath);
                    }
                }
            }
            foreach ($request->images as $img){
                $images[] = $this->uploadFile($img, $this->getModelDirName());

            }
        }
        if(!empty($images)){
            $data['images'] = json_encode($images);
        }

        //upload and delete multiple file
        if ($request->documents != null) {
            //delete old files
            if(!empty($feature->documents)){
                $documents = json_decode($feature->documents, true);
                foreach ($documents as $document) {
                    // Build the full path to the image file
                    foreach ($document as $dm) {
                        $filePath = public_path('uploads/features/files/' . $dm);
                        // Delete the image file if it exists
                        if (File::exists($filePath)) {

                            File::delete($filePath);
                        }
                    }

                }
            }
            //upload new files
            $files = $request->documents;
            $currentDate = now()->toDateString();
            $formattedDate = now()->format('FY');

            $fileObjects = [];
            foreach ($files as $file) {
                $fileName = $currentDate . '-' . uniqid() . '.' . $file->getClientOriginalExtension();

                // Ensure the directory exists, if not, create it
                $directory = public_path('uploads/features/files/' . $formattedDate);
                if (!file_exists($directory)) {
                    mkdir($directory, 0777, true);
                }

                // Move the file to the desired directory
                $path = $file->move($directory, $fileName);

                // Create file object for JSON encoding
                $fileObject = [
                    'download_link' => 'uploads/features/files/' . $formattedDate . '/' . $fileName,
                    'original_name' => $file->getClientOriginalName(),
                ];
                $fileObjects[] = $fileObject;
            }

            // Save the JSON-encoded file objects to your model
            $data['files'] = json_encode($fileObjects);
        }

        //Update User Creation
        $feature->update($data);

        return $feature;
    }


}
