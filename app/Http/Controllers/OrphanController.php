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
        $residences = auth()->user()->country->residences()->get();

        return view('client.pages.create')
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

}