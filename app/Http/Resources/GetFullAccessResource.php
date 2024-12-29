<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GetFullAccessResource extends JsonResource
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
            "created_at" => $this->created_at,
            "first_name" => $this->whenLoaded('sender')->first_name ?? null,
            "last_name" => $this->whenLoaded('sender')->last_name ?? null,
            "avatar" => $this->whenLoaded('sender')->avatar ?? null,
            "email" => $this->whenLoaded('sender')->email ?? null,
            "status" => $this->load('sender.companyMeta')->sender->companyMeta->premium_status ?? null,
            "company_meta_id" => $this->load('sender.companyMeta')->sender->companyMeta->id ?? null,
            // "refer_by" => $this->load('sender')->first_name,
        ];
    }
}
