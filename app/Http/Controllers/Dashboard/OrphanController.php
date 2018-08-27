<?php

namespace App\Http\Controllers\Dashboard;

use App\Common\Controllers\Dashboard\OrphanControllerAbstract;
use App\Http\Requests\Dashboard\Orphan\StoreRequest;
use App\Http\Requests\Dashboard\Orphan\UpdateRequest;
use App\Models\Orphan;
use App\Services\PhotoUploader;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

final class OrphanController extends OrphanControllerAbstract
{

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
        return view('dashboard.pages.orphans.create');
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
        return view('dashboard.pages.orphans.edit')
            ->with('orphan', $orphan);
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
