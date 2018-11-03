<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Residence;
use Illuminate\Http\Request;
use App\Common\Controllers\Dashboard\ResidenceControllerAbstract;

final class ResidenceController extends ResidenceControllerAbstract
{

    public function index(Request $request)
    {
        $residences = parent::index($request);

        return view('dashboard.pages.residences.index')
            ->with('residences', $residences);
    }

    public function create(Request $request)
    {
        $countries = parent::create($request);

        return view('dashboard.pages.residences.create')
            ->with('countries', $countries);
    }

    public function store(Request $request)
    {
        $residence = parent::store($request);

        return redirect()->route('dashboard.residences.index', $residence);
    }

    public function edit(Residence $residence)
    {
        $countries = parent::edit($residence);

        return view('dashboard.pages.residences.edit')
            ->with('countries', $countries)
            ->with('residence', $residence);
    }

    public function update(Request $request, Residence $residence)
    {
        parent::update($request, $residence);

        return redirect()
            ->route('dashboard.residences.edit', $residence);
    }

    public function destroy(Residence $residence)
    {
        parent::destroy($residence);

        return redirect()
            ->route('dashboard.residences.index');
    }

}
