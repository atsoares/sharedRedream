<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use App\Http\Resources\TransactionResource;
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
            'created_at' => Carbon::create($this->created_at)->format('d-m-Y H:i:s'),
            'refunded' => $this->when($this->refunded !== null, $this->refunded),
            'refunded_at' => $this->when($this->refunded === true, Carbon::create($this->refunded_at)->format('d-m-Y H:i:s')),
            'transactions' => TransactionIncidentResource::collection($this->transactions)
        ];
    }
}
