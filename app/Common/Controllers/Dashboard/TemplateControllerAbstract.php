<?php
    /**
     * Created by PhpStorm.
     * User: 38095
     * Date: 08.08.2018
     * Time: 21:55
     */

    namespace App\Common\Controllers\Dashboard;

    use App\Models\Template;
    use App\Models\User;
    use App\Models\Orphan;
    use Illuminate\Http\Request;
    use App\Services\PhotoUploader;
    use App\Common\Controllers\Controller;

    abstract class TemplateControllerAbstract extends Controller
    {

        /**
         * @param Request $request
         * @return mixed
         */
        public function index(Request $request)
        {
            $template = Template::all();

            return $template;
        }

        /**
         * @param Request $request
         * @param PhotoUploader $uploader
         * @return User|\Illuminate\Database\Eloquent\Model
         */
        public function store(Request $request, PhotoUploader $uploader)
        {
            $data = $request->only([
                'title'
            ]);

            $photo = $uploader->upload($request->file('photo'));

            $data['url'] = $photo;

            $template = Template::create($data);

            return $template;
        }

        /**
         * @param Request $request
         * @param Template $template
         * @return Template
         */
        public function update(Request $request, Template $template)
        {
            $data = $request->only([
                'title'
            ]);

            $template->update($data);

            return $template;
        }

        /**
         * @param Template $template
         * @return bool|null
         * @throws \Exception
         */
        public function destroy(Template $template)
        {
            return $template->delete();
        }

    }
