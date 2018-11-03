<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

final class LayoutController extends Controller
{

    public function index()
    {
        return view('dashboard.pages.layouts.index');
    }

    public function create(Request $request)
    {
        return view('dashboard.pages.layouts.create');
    }

}
