<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
/**
* @bodyParam email email required The email of the user. Example: demo@demo.com
* @bodyParam password password required The password of the user. Example: password
*/
class LoginUserRequest extends BaseRequest
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
            'email' => 'required|string|email',
            'password' => 'required|string|min:8'
        ];

        return $rules;
    }
}