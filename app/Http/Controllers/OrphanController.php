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
use App\Services\PhotoUploader;
use Illuminate\Http\Request;
use App\Common\Controllers\Dashboard\OrphanControllerAbstract;

final class OrphanController extends OrphanControllerAbstract
{

    public function show(Orphan $orphan)
    {
        $photos = $orphan->photos()->get();
        $countries = Country::all();

        return view('client.pages.profile')
            ->with('orphan', $orphan)
            ->with('photos', $photos)
            ->with('countries', $countries);
    }

    public function create()
    {
        return view('client.pages.profile');
    }

    /**
     * @param Request $request
     * @param PhotoUploader $uploader
     * @return \App\Models\User|\Illuminate\Database\Eloquent\Model|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, PhotoUploader $uploader)
    {
        $orphan = parent::store($request, $uploader);

        return redirect()->route('country')
            ->with('country', $orphan->country_id);
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