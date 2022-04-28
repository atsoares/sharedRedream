<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'operation' => $this->operation,
            'user_id' => $this->user_id,
            'incident_id' => $this->incident_id,
            'redeem_voucher_id' => $this->redeem_voucher_id,
            'value' => $this->value,
        ];
    }
}
