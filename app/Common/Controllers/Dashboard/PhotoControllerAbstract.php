<?php
/**
 * Created by PhpStorm.
 * User: 38095
 * Date: 08.08.2018
 * Time: 21:55
 */

namespace App\Common\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Services\PhotoUploader;
use App\Common\Controllers\Controller;

abstract class PhotoControllerAbstract extends Controller
{

    protected $uploader;

    public function __construct(PhotoUploader $uploader)
    {
        $this->uploader = $uploader;
    }

    public function upload(Request $request)
    {
        return $this->uploader->upload($request);
    }

}
