<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PositionResourec extends JsonResource
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
            "position_id" => $this->id,
            "position_name" => $this->whenLoaded('profession')->name ?? null,
            "employer_id" => $this->whenLoaded('company')->id ?? null,
            "first_name" => $this->whenLoaded('company')->first_name ?? null,
            "last_name" => $this->whenLoaded('company')->last_name ?? null,
            "avatar" => $this->whenLoaded('company')->avatar ?? null,
            "email" => $this->whenLoaded('company')->email ?? null,
            "phone_no" => $this->whenLoaded('company')->phone_no ?? null,
            'company_name' => $this->load('company.companyMeta')->company->companyMeta->company_name ?? null,
            'current_role' => $this->load('company.companyMeta')->company->companyMeta->current_role ?? null,
            'is_specfic_state' => $this->is_specfic_state,
            'job_posted_date' => $this->created_at ?? null

        ];
    }
}
