<?php

namespace App\Http\Controllers\Dashboard;

use App\Attributes\RoleAttributes;
use App\Http\Requests\Dashboard\User\StoreRequest;
use App\Http\Requests\Dashboard\User\UpdateRequest;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use App\Common\Controllers\Dashboard\UserControllerAbstract;

final class UserController extends UserControllerAbstract
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function index(Request $request)
    {
        $users = parent::index($request);

        return view('dashboard.pages.users.index')
            ->with('users', $users);
    }

    /**
     * @param Request $request
     * @return UserControllerAbstract[]|\Illuminate\Contracts\View\Factory|\Illuminate\Database\Eloquent\Collection|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $countries = parent::create($request);

        return view('dashboard.pages.users.create')
            ->with('countries', $countries);
    }

    /**
     * @param StoreRequest $request
     * @return User|\Illuminate\Database\Eloquent\Model|\Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        parent::store($request);

        return redirect()->route('dashboard.users.index');
    }

    /**
     * @param User $user
     * @return Country[]|\Illuminate\Contracts\View\Factory|\Illuminate\Database\Eloquent\Collection|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        $countries = parent::edit($user);

        return view('dashboard.pages.users.edit')
            ->with('user', $user)
            ->with('countries', $countries);
    }

    /**
     * @param UpdateRequest $request
     * @param User $user
     * @return User|\Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, User $user)
    {
        parent::update($request, $user);

        return redirect()->route('dashboard.users.index');
    }

    /**
     * @param User $user
     * @return bool|\Illuminate\Http\RedirectResponse|null
     * @throws \HttpInvalidParamException
     */
    public function destroy(User $user)
    {
        parent::destroy($user);

        return redirect()->route('dashboard.users.index');
    }

}
