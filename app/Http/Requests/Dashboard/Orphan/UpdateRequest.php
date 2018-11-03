<?php

namespace App\Http\Requests\Dashboard\Orphan;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'birthday'                      => 'sometimes|date',
            'class'                         => 'sometimes|integer',

            'photos'                        => 'sometimes|array|min:1',
            'photos.*.url'                  => 'sometimes|string',
            'photos.*.main'                 => 'sometimes|boolean',
            'photos.*.weight'               => 'sometimes|integer',

        ];
    }
}
