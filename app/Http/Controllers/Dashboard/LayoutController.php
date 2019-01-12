<?php

namespace App\Http\Controllers\Dashboard;

use App\Attributes\RoleAttributes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

final class LayoutController extends Controller
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

    public function index()
    {
        return view('dashboard.pages.layouts.index');
    }

    public function create(Request $request)
    {
        return view('dashboard.pages.layouts.create');
    }

}
