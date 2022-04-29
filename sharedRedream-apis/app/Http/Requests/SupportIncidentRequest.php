<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

/**
 * @bodyParam user_id int required The id of the user trying to support the incident. Example: 2
 * @bodyParam value int required The value amount deposit by the user to help incident. Example: 40
*/
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
    }
}