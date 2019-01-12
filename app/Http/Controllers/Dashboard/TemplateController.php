<?php

namespace App\Http\Controllers\Dashboard;

use App\Attributes\RoleAttributes;
use App\Models\Template;
use Illuminate\Http\Request;
use App\Services\PhotoUploader;
use App\Common\Controllers\Dashboard\TemplateControllerAbstract;

final class TemplateController extends TemplateControllerAbstract
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
	 * @param Request $request
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index(Request $request)
	{
		$templates = parent::index($request);
		
		return view('dashboard.pages.templates.index')
			->with('templates', $templates);
	}
	
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function create()
	{
		return view('dashboard.pages.templates.create');
	}
	
	/**
	 * @param Request       $request
	 * @param PhotoUploader $uploader
	 *
	 * @return \App\Models\User|\Illuminate\Database\Eloquent\Model|\Illuminate\Http\RedirectResponse
	 */
	public function store(Request $request, PhotoUploader $uploader)
	{
		parent::store($request, $uploader);
		
		return redirect()->route('dashboard.templates.index');
	}
	
	
	public function edit(Template $template)
	{
		return view('dashboard.pages.templates.edit')
			->with('template', $template);
	}
	
	public function update(Request $request, Template $template)
	{
		$template = parent::update($request, $template);
		
		return redirect()->route('dashboard.templates.edit', $template);
	}
	
	public function destroy(Template $template)
	{
		parent::destroy($template);
		
		return redirect()->back();
	}
	
	
}
