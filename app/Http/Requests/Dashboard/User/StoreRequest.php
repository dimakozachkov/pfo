<?php

namespace App\Http\Requests\Dashboard\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'email' => 'required|email',
            'login' => 'required|string|max:255|unique:users,login',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|integer',
            'country' => 'required|exists:countries,id'
        ];
    }
}
