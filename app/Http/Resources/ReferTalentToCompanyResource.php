<?php

namespace App\Http\Resources;

use App\Http\Resources\PositionResourec;
use Illuminate\Http\Resources\Json\JsonResource;

class ReferTalentToCompanyResource extends JsonResource
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
            "id" => $this->id,
            "positionDetail" => PositionResourec::make($this->position),
        ];
    }
}
