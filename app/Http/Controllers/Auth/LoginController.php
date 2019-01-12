<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Hashing\BcryptHasher;

class LoginController extends Controller
{

    private $hasher;

    public function __construct()
    {
        $this->hasher = new BcryptHasher();
        $this->middleware('guest')->except('logout');
    }

    /**
     * @param string $login
     * @param string $password
     * @return bool
     */
    private function attempt(string $login, string $password): bool
    {
        return auth()->attempt([
            'login' => $login,
            'password' => $password
        ]);
    }

    /**
     * @param string $login
     * @return User
     */
    private function getUser(string $login): User
    {
        return User::where('login', $login)->first();
    }

    /**
     * @param string $password
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    private function checkUser(string $password, User $user)
    {
        if ($this->hasher->check($password, $user->getAuthPassword())) {
            auth()->login($user);

            if ($user->can('is-admin')) {
                return redirect()->route('dashboard.index');
            }

            return redirect()->route('home');
        }
    }

    /**
     * @param LoginRequest $request
     * @return string
     */
    public function login(LoginRequest $request)
    {
        $login = $request->input('login');
        $password = $request->input('password');

        if ($this->attempt($login, $password)) {
            $user = $this->getUser($login);

            return $this->checkUser($password, $user);
        }

        return redirect()->route('login');

    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        \Auth::logout();

        return redirect()->route('login');
    }
}
