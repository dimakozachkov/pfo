<?php
/**
 * Created by PhpStorm.
 * User: 38095
 * Date: 13.08.2018
 * Time: 21:36
 */

namespace App\Http\Controllers;

use App\Models\Residence;
use Illuminate\Http\Request;
use App\Common\Controllers\Dashboard\PhotoControllerAbstract;

class ResidenceController extends PhotoControllerAbstract
{

    public function index()
    {
        $country = auth()->user()->country;
        $residences = $country->residences()->get();

        return view('client.pages.residence')
            ->with('residences', $residences);
    }

    public function store(Request $request)
    {
        $country = auth()->user()->country;
        $country->residences()->create($request->all());

        return redirect()->back();
    }

    public function update(Request $request, Residence $residence)
    {
        $residence->update($request->all());

        return redirect()->back();
    }

}