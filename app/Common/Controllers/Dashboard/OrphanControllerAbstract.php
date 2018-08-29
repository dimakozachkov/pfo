<?php
/**
 * Created by PhpStorm.
 * User: 38095
 * Date: 08.08.2018
 * Time: 21:55
 */

namespace App\Common\Controllers\Dashboard;

use App\Models\User;
use App\Models\Orphan;
use Illuminate\Http\Request;
use App\Services\PhotoUploader;
use App\Common\Controllers\Controller;

abstract class OrphanControllerAbstract extends Controller
{

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $users = Orphan::filter($request)->paginate();

        return $users;
    }

    /**
     * @param Request $request
     * @param PhotoUploader $uploader
     * @return User|\Illuminate\Database\Eloquent\Model
     */
    public function store(Request $request, PhotoUploader $uploader)
    {
        $data = $request->only([
            'first_name', 'last_name', 'address',
            'country_id', 'residence_id', 'birthday',
            'class', 'about',
        ]);

        $orphan = Orphan::create($data);

        if ($request->hasFile('photo')) {
            $photo = $uploader->upload($request->file('photo'));

            $orphan->photos()->create([
                'url' => $photo,
                'weight' => 100,
                'main' => true,
            ]);
        }

        return $orphan;
    }

    /**
     * @param Request $request
     * @param Orphan $orphan
     * @param PhotoUploader $uploader
     * @return Orphan
     */
    public function update(Request $request, Orphan $orphan, PhotoUploader $uploader)
    {
        $data = $request->only([
            'first_name', 'last_name', 'address',
            'country_id', 'residence_id', 'birthday',
            'class', 'about',
        ]);

        if (count($data) > 0) {
            $orphan->update($data);
        }

        if ($request->hasFile('photo')) {
            $photo = $uploader->upload($request->file('photo'));

            $orphan->photos()->update(['main' => false]);

            $orphan->photos()->create([
                'url' => $photo,
                'weight' => 100,
                'main' => true,
            ]);
        }

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photoFile) {
                $photo = $uploader->upload($photoFile);
                $orphan->photos()->create([
                    'url' => $photo,
                    'weight' => rand(0, 99),
                    'main' => false,
                ]);
            }
        }

        return $orphan;
    }

    /**
     * @param Orphan $orphan
     * @return bool|null
     * @throws \Exception
     */
    public function destroy(Orphan $orphan)
    {
        return $orphan->delete();
    }

}
