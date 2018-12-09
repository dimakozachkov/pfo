<?php
/**
 * Created by PhpStorm.
 * User: 38095
 * Date: 13.08.2018
 * Time: 21:36
 */

namespace App\Http\Controllers;

use App\Models\Orphan;
use App\Models\Country;
use App\Models\Template;
use Illuminate\Http\Request;
use App\Services\PhotoUploader;
use App\Common\Controllers\Dashboard\OrphanControllerAbstract;

final class OrphanController extends OrphanControllerAbstract
{

    public function show(Orphan $orphan)
    {
        $photos = $orphan->photos()->get();
        $country = $orphan->country;
        $countries = Country::all();
        $templates = Template::all();
        $residences = auth()->user()->country->residences()->get();

        return view('client.pages.profile')
            ->with('orphan', $orphan)
            ->with('country', $country)
            ->with('photos', $photos)
            ->with('countries', $countries)
            ->with('residences', $residences)
            ->with('templates', $templates);
    }

    public function create()
    {
        $countries = Country::all();
        $residences = auth()->user()
            ->country()
            ->first()
            ->residences()
            ->get();

        return view('client.pages.create')
            ->with('countries', $countries)
            ->with('residences', $residences);
    }

    /**
     * @param Request $request
     * @param PhotoUploader $uploader
     * @return \App\Models\User|\Illuminate\Database\Eloquent\Model|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, PhotoUploader $uploader)
    {
        $orphan = parent::store($request, $uploader);

        return redirect()->route('country', $orphan->country);
    }

    public function update(Request $request, Orphan $orphan, PhotoUploader $uploader)
    {
        $orphan = parent::update($request, $orphan, $uploader);

        return redirect()->route('orphans.show', $orphan);
    }

    public function destroy(Orphan $orphan)
    {
        $orphan->delete();

        return redirect()->route('home');
    }

	public function statistic(Request $request, Orphan $orphan)
	{
		$templates = Template::all();
		$statistics = $orphan->statistic()
			->orderByDesc('created_at')
			->paginate()
			->appends($request->all());

		$countDownloads = [];

		foreach ($templates as $template) {
			if (isset($countDownloads[$template->title])) {
				$countDownloads[$template->title] += 1;
			} else {
				$countDownloads[$template->title] = 1;
			}
		}

		return view('client.pages.statistic')
			->with('countDownloads', $countDownloads)
			->with('statistics', $statistics);

    }

}
