<?php
/**
 * Created by PhpStorm.
 * User: 38095
 * Date: 08.08.2018
 * Time: 21:55
 */

namespace App\Common\Controllers\Dashboard;

use App\Models\User;
use App\Models\Country;
use App\Models\Residence;
use Illuminate\Http\Request;
use App\Common\Controllers\Controller;

abstract class ResidenceControllerAbstract extends Controller
{

    /**
     * @return Country[]|\Illuminate\Database\Eloquent\Collection
     */
    private function getCountries()
    {
        $countries = Country::all();

        return $countries;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $residences = Residence::filter($request)->paginate();

        return $residences;
    }

    /**
     * @param Request $request
     * @return Country[]|\Illuminate\Database\Eloquent\Collection
     */
    public function create(Request $request)
    {
        return $this->getCountries();
    }

    /**
     * @param Request $request
     * @return User|\Illuminate\Database\Eloquent\Model
     */
    public function store(Request $request)
    {
        $data = $request->except(['country']);
        $data['country_id'] = $request->input('country');

        return Residence::create($data);
    }

    /**
     * @param Residence $residence
     * @return Country[]|\Illuminate\Database\Eloquent\Collection
     */
    public function edit(Residence $residence)
    {
        return $this->getCountries();
    }

    /**
     * @param Request $request
     * @param Residence $residence
     * @return Residence|User
     */
    public function update(Request $request, Residence $residence)
    {
        $residence->update($request->all());

        return $residence;
    }

    /**
     * @param Residence $residence
     * @return bool|null
     * @throws \Exception
     */
    public function destroy(Residence $residence)
    {
        return $residence->delete();
    }

}
