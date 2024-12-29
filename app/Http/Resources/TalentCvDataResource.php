<?php

namespace App\Http\Resources;

use App\Http\Resources\SkillResource;
use App\Http\Resources\TalentMetaResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TalentCvDataResource extends JsonResource
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
            'first_name' => $this->first_name ?? null,
            'last_name' => $this->last_name ?? null,
            'email' => $this->email,
            'phone_no' => $this->phone_no ?? null,
            'avatar' => $this->avatar ?? null,
            'talentMeta' => TalentMetaResource::make($this->talentMeta),
            'skills' => SkillResource::collection($this->talentSkils),
        ];
    }
}
