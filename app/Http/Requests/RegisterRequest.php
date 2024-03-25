<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => 'required|email:email',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:8',
            'name' => 'required',
            'department_id' => 'required',
            // 'role_id' => 'required',
            // 'password_confirmation' => 'required|same:password'
        ];
    }
}