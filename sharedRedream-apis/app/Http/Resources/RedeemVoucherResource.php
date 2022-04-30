<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RedeemVoucherResource extends JsonResource
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
            'token' => $this->token,
            'user_id' => $this->when($this->user_id !== null, $this->user_id),
            'value' => $this->value,
            'used_at' => $this->when($this->refunded_at !== null, $this->refunded_at)
        ];
    }
}
