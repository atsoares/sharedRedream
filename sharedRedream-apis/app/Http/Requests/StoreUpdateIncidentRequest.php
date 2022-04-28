<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class StoreUpdateIncidentRequest extends BaseRequest
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
            'title' => 'required|max:50',
            'description' => 'required|max:200',
            'user_id' => 'required',
            'refunded' => 'boolean',
        ];

        return $rules;
    }
}