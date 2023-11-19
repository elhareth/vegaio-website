<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user' => UserResource::make($this->whenLoaded('user')),
            'category' => CategoryResource::make($this->whenLoaded('category')),
            'title' => $this->title,
            'content' => $this->content,
            'status' => $this->status,
            'published' => $this->published_at->format('Y-m-d H:i'),
            'comments' => CommentResource::collection($this->whenLoaded('comments')),
        ];
    }
}
