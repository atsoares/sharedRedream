<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class SupportIncidentRequest extends BaseRequest
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
            'user_id' => 'required',
            'value' => 'required|min:1|max:100'
        ];

        return $rules;
    }
}