<?php

namespace App\Http\Controllers\Dashboard;

use App\Attributes\RoleAttributes;
use App\Common\Controllers\Dashboard\OrphanControllerAbstract;
use App\Models\Country;
use App\Models\Orphan;
use App\Models\Residence;
use App\Services\PhotoUploader;
use Illuminate\Http\Request;

final class OrphanController extends OrphanControllerAbstract
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = auth()->user();

            if ($user->role === RoleAttributes::USER) {
                return redirect()->route('home');
            }

            return $next($request);
        });
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $orphans = parent::index($request);

        return view('dashboard.pages.orphans.index')
            ->with('orphans', $orphans);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $countries = Country::all();
        $residences = Residence::all();

        return view('dashboard.pages.orphans.create')
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
        parent::store($request, $uploader);

        return redirect()->route('dashboard.orphans.index');
    }


    public function edit(Orphan $orphan)
    {
        $countries = Country::all();
        $residences = Residence::all();

        return view('dashboard.pages.orphans.edit')
            ->with('orphan', $orphan)
            ->with('countries', $countries)
            ->with('residences', $residences);
    }

    public function update(Request $request, Orphan $orphan, PhotoUploader $uploader)
    {
        $orphan = parent::update($request, $orphan, $uploader);

        return redirect()->route('dashboard.orphans.edit', $orphan);
    }

    public function destroy(Orphan $orphan)
    {
        parent::destroy($orphan);

        return redirect()->back();
    }


}
