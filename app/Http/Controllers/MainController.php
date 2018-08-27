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
use Illuminate\Http\Request;

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

    public function profile(Orphan $orphan)
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

    public function store(Request $request)
    {
        $data = $request->only([
            'first_name', 'last_name', 'address',
            'birthday', 'class', 'about',
        ]);

        $orphan = Orphan::create($data);

        return redirect()->route('country')
            ->with('country', $orphan->country_id);
    }

    public function update(Request $request, Orphan $orphan)
    {
        $data = $request->only([
            'first_name', 'last_name', 'address',
            'birthday', 'class', 'country_id',
            'about',
        ]);

        $orphan->update($data);

        return redirect()->route('orphans.show', $orphan);
    }

}