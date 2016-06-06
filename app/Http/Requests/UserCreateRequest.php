<?php

namespace App\Http\Requests;

class UserCreateRequest extends Request
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
            'first_name' => 'required|min:2|max:30|alpha',
            'name' => 'required|min:2|max:30|alpha',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:5|confirmed',
            'organisation' => 'required',
            'equipe' => 'required'
        ];
    }
}
