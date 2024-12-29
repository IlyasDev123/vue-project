<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployerCvDataResource extends JsonResource
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
            'first_name' => $this->whenLoaded('company')->first_name ?? null,
            'last_name' => $this->whenLoaded('company')->last_name ?? null,
            'phone_no' => $this->whenLoaded('company')->phone_no ?? null,
            'email' => $this->whenLoaded('company')->email ?? null,
            'avatar' => $this->whenLoaded('company')->avatar ?? null,
            'company_name' => $this->load('company.companyMeta')->company->companyMeta->company_name ?? null,
            'current_role' => $this->load('company.companyMeta')->company->companyMeta->current_role ?? null,
            'position_name' => $this->whenLoaded('profession')->name ?? null,
            'salary' => $this->whenLoaded('salary')->start_range ?? null,
            'experience' => $this->whenLoaded('experience')->start_range ?? null,
            'country_name' => $this->whenLoaded('state')->name ?? null,
            'company_id' => $this->whenLoaded('company')->id ?? null,
            'teamLoveableAspect' => $this->whenLoaded('teamLoveableAspect')->name ?? null,
            'managementStyles' => $this->whenLoaded('managementStyles'),
            'job_type' => $this->whenLoaded('preferWorkLocation')->name ?? null,
            'is_specfic_state' => $this->is_specfic_state,
            'job_posted_date' => $this->created_at ?? null
        ];
    }
}
