<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'email' => $this->email,
            'username' => $this->username,
            'info' => $this->user_info,
            'role' => $this->role,
            'status' => $this->status,
            'metalist' => $this->whenLoaded('metalist', $this->metalist),
        ];
    }
}
