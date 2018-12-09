<?php

namespace App\Http\Requests\Dashboard\User;

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
            'email'         => 'sometimes|nullable|email',
            'password'      => 'sometimes|nullable|min:6|confirmed',
            'role'          => 'sometimes|integer',
            'country'       => 'sometimes|exists:countries,id',
        ];
    }
}
