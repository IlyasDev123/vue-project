<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PublicPostsResource extends JsonResource
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
            'permission_status' => $this->permission_status,
            'user_id' => $this->user_id,
            'created_at' => Carbon::parse($this->created_at)->diffForHumans(),
            'updated_at' => Carbon::parse($this->updated_at)->diffForHumans(),
            'userlikes_posts_count' => $this->userlikes_posts_count,
            'is_liked' => $this->isAuthUserLikedPost(),
            'post_meta' => $this->postMeta,
            'user' => $this->user,
        ];
    }
}
