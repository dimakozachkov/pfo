<?php
/**
 * Created by PhpStorm.
 * User: 38095
 * Date: 08.08.2018
 * Time: 21:55
 */

namespace App\Common\Controllers\Dashboard;

use App\Attributes\RoleAttributes;
use App\Events\UserCreatedEvent;
use App\Http\Requests\Dashboard\User\StoreRequest;
use App\Http\Requests\Dashboard\User\UpdateRequest;
use App\Models\Country;
use App\Models\User;
use App\Common\Controllers\Controller;
use Illuminate\Http\Request;

abstract class UserControllerAbstract extends Controller
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
        $users = User::with('country')
            ->filter($request)
            ->paginate();

        return $users;
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
     * @param StoreRequest $request
     * @return User|\Illuminate\Database\Eloquent\Model
     */
    public function store(StoreRequest $request)
    {
        $data = $request->only([
            'email', 'password', 'role', 'login',
        ]);

        $data['password'] = bcrypt($data['password']);
        $data['country_id'] = $request->input('country');

        $user = User::create($data);

        event(new UserCreatedEvent($user));

        return $user;
    }

    /**
     * @return Country[]|\Illuminate\Database\Eloquent\Collection
     */
    public function edit(User $user)
    {
        return $this->getCountries();
    }

    public function update(UpdateRequest $request, User $user)
    {
        $data = $request->only([
            'email', 'password', 'role',
        ]);

        $hasPassword = $request->has('password')
            && !empty($request->input('password'));

        if ($hasPassword) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        if ($request->has('country')) {
            $data['country_id'] = $request->input('country');
        }

        $user->update($data);

        if ($request->has('email')) {
            event(new UserCreatedEvent($user));
        }

        return $user;
    }

    /**
     * @param User $user
     * @return bool|null
     * @throws \HttpInvalidParamException
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        if (RoleAttributes::ROOT === $user->role) {
            throw new \HttpInvalidParamException('You don\'t have permissions.');
        }

        return $user->delete();
    }

}
