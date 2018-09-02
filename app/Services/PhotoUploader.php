<?php
/**
 * Created by PhpStorm.
 * User: 38095
 * Date: 13.08.2018
 * Time: 21:37
 */

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class PhotoUploader
{

    /**
     * @param string $dir
     * @return bool
     */
    protected function existDir(string $dir): bool
    {
        return is_dir($dir);
    }

    /**
     * @param string $dir
     */
    protected function makeDir(string $dir)
    {
        if (!$this->existDir($dir)) {
            mkdir($dir);
        }
    }

    /**
     * @return string
     */
    protected function generatePhotoName($file)
    {
        $name = Str::random(32);
        $fileExt = $file->getClientOriginalExtension();

        return "$name.$fileExt";
    }

    /**
     * @param $photo
     * @param string $path
     * @return string
     */
    public function upload($photo, $path = 'public/photos')
    {
        $photoPath = public_path('photos');

        $this->makeDir($photoPath);

        $photoName = $this->generatePhotoName($photo);

        $photo->storeAs($path, $photoName);

        return $photoName;
    }

}