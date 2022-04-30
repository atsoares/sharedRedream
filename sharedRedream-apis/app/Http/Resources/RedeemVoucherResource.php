<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

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
            'user' => $this->when($this->user !== null, $this->user->id),
            'value' => $this->value,
            'used_at' => $this->when($this->refunded_at !== null, Carbon::create($this->refunded_at)->format('d-m-Y H:i:s'))
        ];
    }
}
