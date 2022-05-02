<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

/**
 * @bodyParam title string required The title of the incident. Example: Need help
 * @bodyParam description string required The description of the incident. Example: Need help for something..
 * @bodyParam user_id int required The id of the user trying to create the incident. Example: 2
*/
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
            'title' => 'required|max:50|unique:incidents',
            'description' => 'required|max:200',
            'goal' => 'required|integer',
            'user_id' => 'required',
            'expires_at' => 'date|after:today'
        ];
    }
}