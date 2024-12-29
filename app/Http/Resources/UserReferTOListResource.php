<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserReferTOListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $recommendedBy = "";
        $children = $this->whenLoaded('children');
        if($children){
            $recommendedBy = $children->first_name.' '.$children->last_name;
        }

        $profession = "";
        $jobInterest = $this->whenLoaded('jobInterest');
        if($jobInterest){
            $profession = $jobInterest->profession->name ?? null;
        }

        return [
            'id' => $this->id,
            'name' => $this->first_name . ' ' . $this->last_name ?? null,
            'recommend_by' => $recommendedBy,
            'profession' => $profession,
            'avatar' => $this->avatar,
            'refer_by_id' => $this->recruiter_id
        ];
    }
}