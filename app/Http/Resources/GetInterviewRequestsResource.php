<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class GetInterviewRequestsResource extends JsonResource
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
            "first_name" => $this->whenLoaded('company')->first_name ?? null,
            "last_name" => $this->whenLoaded('company')->last_name ?? null,
            "avatar" => $this->whenLoaded('company')->avatar ?? null,
            "email" => $this->whenLoaded('company')->email ?? null,
            "created_at" => Carbon::parse($this->created_at)->diffForHumans(),
            "requestfor" => $this->whenLoaded('talent')->first_name ?? null,
            "status" => 0
        ];
    }
}
