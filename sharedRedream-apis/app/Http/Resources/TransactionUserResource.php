<?php

namespace App\Http\Resources;

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
            'incident_id' => $this->when($this->operation !== 'voucher_redeem', $this->incident_id),
            'redeem_voucher_id' => $this->when($this->operation === 'voucher_redeem', $this->redeem_voucher_id),
            'value' => $this->value,
        ];
    }
}
