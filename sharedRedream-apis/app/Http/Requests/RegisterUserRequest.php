<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

/**
 * @bodyParam name string required The name of the user. Example: Demo
 * @bodyParam email email required The email of the user. Example: demo@demo.com
 * @bodyParam password password required The password of the user. Example: password
*/
class RegisterUserRequest extends BaseRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ];
   }
}