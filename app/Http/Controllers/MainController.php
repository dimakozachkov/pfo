<?php
/**
 * Created by PhpStorm.
 * User: 38095
 * Date: 13.08.2018
 * Time: 21:36
 */

namespace App\Http\Controllers;

use App\Models\Country;
use App\Common\Controllers\Dashboard\PhotoControllerAbstract;
use App\Models\Orphan;
use App\Models\Residence;
use App\Models\Template;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class MainController extends PhotoControllerAbstract
{

    public function index()
    {
        $countries = Country::all();

        return view('client.pages.index')
            ->with('countries', $countries);
    }

    public function country(Country $country)
    {
        $orphans = $country->orphans()->paginate();

        return view('client.pages.list')
            ->with('country', $country)
            ->with('orphans', $orphans);
    }

    public function find(Request $request)
    {
        $orphans = Orphan::filter($request)->paginate();
        $residences = Residence::all();
        $templates = Template::all();

        return view('client.pages.find')
            ->with('residences', $residences)
            ->with('orphans', $orphans)
            ->with('templates', $templates);
    }

    public function download(Orphan $orphan, Template $template)
    {
        $orphanPhoto = $orphan->main_photo;
        $templatePhoto = $template->url;

        $orphanPath = public_path('storage/photos') . "/{$orphanPhoto}";
        $templatePath = public_path('img/templates') . "/{$templatePhoto}";

        $img = Image::make($orphanPath)->resize(1200, 1800);

        $watermark = Image::make($templatePath);
        $img->insert($watermark, 'center');

        return $img->response();
    }

}