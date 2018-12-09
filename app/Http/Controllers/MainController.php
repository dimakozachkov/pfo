<?php
/**
 * Created by PhpStorm.
 * User: 38095
 * Date: 13.08.2018
 * Time: 21:36
 */

namespace App\Http\Controllers;

use App\Models\DownloadAccount;
use Storage;
use Zip;
use App\Models\Country;
use App\Common\Controllers\Dashboard\PhotoControllerAbstract;
use App\Models\Orphan;
use App\Models\Residence;
use App\Models\Template;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class MainController extends PhotoControllerAbstract
{
	
	private $zipPath = null;

    public function index()
    {
        $countries = Country::all();

        return view('client.pages.index')
            ->with('countries', $countries);
    }

    public function country(Country $country)
    {
        $orphans = $country->orphans()->orderByDesc('orphan_id')->paginate();

        return view('client.pages.list')
            ->with('country', $country)
            ->with('orphans', $orphans);
    }
	
	public function find(Request $request)
    {
        $orphans = Orphan::filter($request)->orderByDesc('orphan_id')->paginate();
        $countries = Country::with('residences')->get();
        $templates = Template::all();
        
        $title = '';
        
        if ($request->has('residence_id') && !empty($request->input('residence_id'))) {
        	$title = Residence::findOrFail($request->input('residence_id'))->title;
        } elseif ($request->has('search')) {
        	$search = $request->input('search');
        	
        	$title = $search;
        }
        
        $orphansIds = collect($orphans->toArray()['data'])
	        ->pluck('id')->toArray();
        
        return view('client.pages.find')
            ->with('countries', $countries)
            ->with('orphans', $orphans)
            ->with('templates', $templates)
	        ->with('title', $title)
	        ->with('orphansIds', $orphansIds);
    }
	
	public function download(Request $request, Template $template)
	{
		$orphansIds = $request->input('orphans');
		$orphans = Orphan::whereIn('id', $orphansIds)->get();
		
		return view('client.pages.download')
			->with('orphans', $orphans)
			->with('orphansIds', $orphansIds)
			->with('template', $template);
	}
	
	private function makeText(&$watermark, string $title, int $y, int $size, string $fontPath, string $color = '#fff') {
	    $watermark->text(Str::upper($title), 70, $y, function($font) use ($size, $color, $fontPath) {
		    $font->file(public_path("/fonts/$fontPath"));
		    $font->size($size);
		    $font->color($color);
		    $font->align('left');
		    $font->valign('top');
		    $font->angle(0);
	    });
    }
	
	private function downloadAccount(Orphan $orphan, Template $template)
    {
    	DownloadAccount::create([
		    'user_id'       => auth()->id(),
		    'orphan_id'     => $orphan->id,
		    'template_id'   => $template->id,
	    ]);
    }
	
	public function downloadOne(Orphan $orphan, Template $template, DownloadAccount $downloadAccount)
    {
        $orphanPhoto = $orphan->main_photo;
        $templatePhoto = $template->url;
        
        $this->downloadAccount($orphan, $template);

        $orphanPath = public_path('storage/photos') . "/{$orphanPhoto}";
        $templatePath = public_path('storage/img/templates') . "/{$templatePhoto}";

        $img = Image::make($orphanPath)
	        ->resize(1200, 1800);

        $watermark = Image::make($templatePath);
        
        $country = $orphan->country;
	
	    $this->makeText($watermark, $orphan->first_name, 1290, 78, 'RobotoBold/RobotoBold.ttf');
	    $this->makeText($watermark, "{$orphan->id}{$country->code}", 1364, 36, 'RobotoBold/RobotoBold.ttf');
	    $this->makeText($watermark, $country->title, 1404, 36, 'RobotoRegular/RobotoRegular.ttf', '#3F2A7E');
        
        $img->insert($watermark, 'center');

        return $img->response();
    }
	
	private function makeDirName(Request $request, Template $template): string
	{
		$dirName = $template->title;
		
		if ($request->has('search') && !is_null($request->input('search'))) {
			$dirName .= '_' . $request->input('search');
		}
		
		if ($request->has('residence_id') && !is_null($request->input('residence_id'))) {
			$residence = Residence::findOrFail($request->input('residence_id'));
			$countryCode = $residence->country->code;
			$dirName .= '_' . $residence->title . '_' . $countryCode;
		}
		
		return $dirName . '_' . microtime(true);
    }
	
	public function downloadMany(Request $request, Template $template)
	{
		$orphansIds = $request->input('orphans');
		$orphans = Orphan::whereIn('id', $orphansIds)->get();
		
		$templatePhoto = $template->url;
		$templatePath = public_path('storage/img/templates') . "/{$templatePhoto}";
		
		$dirName = $this->makeDirName($request, $template);
		$dirPath = public_path() . '/' . $dirName;
		
		File::makeDirectory($dirPath);
		
		$orphans->each(function ($orphan) use ($template, $templatePath, $dirPath) {
			$this->downloadAccount($orphan, $template);
			
			$orphanPhoto = $orphan->main_photo;
			$photoPath = public_path('storage/photos') . "/{$orphanPhoto}";
			$img = Image::make($photoPath)->resize(1200, 1800);
			$watermark = Image::make($templatePath);
			
			$country = $orphan->country;
			
			$this->makeText($watermark, $orphan->first_name, 1290, 78, 'RobotoBold/RobotoBold.ttf');
			$this->makeText($watermark, "{$orphan->id}{$country->code}", 1364, 36, 'RobotoBold/RobotoBold.ttf');
			$this->makeText($watermark, $country->title, 1404, 36, 'RobotoRegular/RobotoRegular.ttf', '#3F2A7E');
			
			$img->insert($watermark, 'center');
			
			$imgName = $template->title . '_' . $orphan->full_name . '.png';
			
			$img->save($dirPath . '/' . $imgName);
		});
		
		$zipName = "{$dirName}.zip";
		$this->zipPath = public_path($zipName);
		$zip = Zip::create($zipName);
		$zip->add($dirPath, true);
		$zip->close();
		
		File::deleteDirectory($dirPath);
		
		return response()->download(public_path($zipName));
		
	}
	
	public function __destruct()
	{
		if (!is_null($this->zipPath)) {
			File::delete($this->zipPath);
		}
	}
	
}