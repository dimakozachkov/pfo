<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Country;
use App\Services\PhotoUploader;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

final class CountryController extends Controller
{

    public function index(Request $request)
    {
        $countries = Country::filter($request)->paginate();

        return view('dashboard.pages.countries.index')
            ->with('countries', $countries);
    }

    public function create()
    {
        return view('dashboard.pages.countries.create');
    }

    public function store(Request $request, PhotoUploader $uploader)
    {
        $data = $request->only(['code', 'title']);
	
	    if ($request->hasFile('photo')) {
		    $data['icon'] = $uploader->upload($request->file('photo'));
	    }

        Country::create($data);

        return redirect()->route('dashboard.countries.index');
    }

    public function edit(Country $country)
    {
        return view('dashboard.pages.countries.edit')
            ->with('country', $country);
    }

    public function update(Request $request, Country $country, PhotoUploader $uploader)
    {
    	$data = $request->all();
    	
	    if ($request->hasFile('photo')) {
		    $data['icon'] = $uploader->upload($request->file('photo'));
	    }
    	
        $country->update($data);

        return redirect()->route('dashboard.countries.edit', $country);
    }

    public function destroy(Country $country)
    {
        $country->delete();

        return redirect()->back();
    }

}
