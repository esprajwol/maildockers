<?php

namespace App\Traits\File;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Svg\Tag\Image;

trait FileUploadTrait
{
    public function uploadFile(
        $file,
        $folderPath,
        $isImage = true,
        $isResizeRequired = false,
        $width = null,
        $height = null,
        $disk = null
    )
    {

        # Disk Assign
        $disk = empty($disk) ? setDefaultDisk() : $disk;

        // Folder Path Defining
        $dynamicPath = public_path($folderPath);

        $this->dynamicDirCreate($dynamicPath);

        // Selected File Extension
        $extension = $file->getClientOriginalExtension();

        $isSvg = isSvg($extension);

        $extensionName = $isSvg ? ".svg" : ".jpg";
        // File Name generate
        $fileName  = fileRename() . $extensionName;

        // File Path generate Ex. uploads/categories/xyz123.webp
        $filePath = "{$folderPath}/{$fileName}";

        // When image extension is allowed
        if ($isImage && !$isSvg && in_array($extension, allowedImageExtensions())) {
            $manager = new ImageManager(new Driver());

            $img = $manager->read($file);

            if ($isResizeRequired) {
                $img = $img->resize($width, $height)->toJpeg();
            } else {
                $img = $img->toJpeg();
            }

            $img->save($dynamicPath . '/' . $fileName);
        } else {
            $file->move($dynamicPath, $fileName);
        }

        return $filePath;
    }

    public function dynamicDirCreate($dynamicPath)
    {
        // Dynamic Directory creating with Permissions
        if (!file_exists($dynamicPath)) {
            if (!mkdir($dynamicPath, 0777, TRUE) && !is_dir($dynamicPath)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $dynamicPath));
            }
        }

    }


    public function bucketFileUpload($url, $bucketType ="s3")
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_URL, $url);
        $contents = curl_exec($curl);
        curl_close($curl);
        Storage::disk('s3')->put('images/' . $name, $contents, 'public');
        $file_path = Storage::disk('s3')->url('images/' . $name);
    }

}
