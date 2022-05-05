<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

/**
 * @bodyParam token string required The token with 20 characters to be redeem. Example: BW9JREEVNH181H54ISMK
 * @bodyParam user_id int required The id of the user. Example: 2
*/
class RedeemVoucherRequest extends BaseRequest
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
            'token' => 'required|min:20'
        ];
    }
}