<?php

namespace App\Http\Resources;

use App\Http\Resources\TransactionIncidentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class IncidentResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'owner' => $this->user->name,
            'total_raised' => $this->total_raised,
            'goal' => $this->goal,
            'expires_at' => (string) $this->expires_at,
            'created_at' => (string) $this->created_at,
            'refunded' => $this->when($this->refunded != null, $this->refunded),
            'refunded_at' => $this->when($this->refunded === true, (string) $this->refunded_at),
            'transactions' => TransactionIncidentResource::collection($this->transactions)
        ];
    }
}
