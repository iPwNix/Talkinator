<?php

namespace App\Repositories;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;
use File;

class UploadRepository
{

    public function upload_image($image, string $dir)
    {
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        Image::make($image)->save(public_path('uploads/' . $dir . '/' . $imageName));

        return $imageName;
    }

    public function upload_image_resize($image, string $dir, int $width, int $height)
    {
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        Image::make($image)->fit($width, $height)->save(public_path('uploads/' . $dir . '/' . $imageName));

        return $imageName;
    }

    public function delete_old_image($imageName, string $dir)
    {
        $imagePath = public_path('uploads/' . $dir . '/' . $imageName);

        if (!File::exists($imagePath)) {
            return;
        }

        if ($imageName == "default_avatar.jpg" || $imageName == "default_cover.jpg") {
            return;
        }

        File::delete($imagePath);
    }
}