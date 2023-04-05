<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TargetResource extends JsonResource
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
            'target' => $this->target,
            'month' => $this->month,
            'year' => $this->year,
            'cluster_id' => $this->cluster->id
        ];
    }
}
