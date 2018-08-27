<?php
/**
 * Created by PhpStorm.
 * User: 38095
 * Date: 13.08.2018
 * Time: 21:36
 */

namespace App\Http\Controllers;

use App\Models\OrphanPhoto;
use Illuminate\Http\Request;
use App\Services\PhotoUploader;
use App\Common\Controllers\Dashboard\PhotoControllerAbstract;

class PhotoController extends PhotoControllerAbstract
{

    public function __construct(PhotoUploader $uploader)
    {
        parent::__construct($uploader);
    }

    public function upload(Request $request)
    {
        return parent::upload($request);
    }

    /**
     * @param OrphanPhoto $photo
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(OrphanPhoto $photo)
    {
        if ($photo->main_photo !== 1) {
            $photo->delete();
        }

        return redirect()->back();
    }


}