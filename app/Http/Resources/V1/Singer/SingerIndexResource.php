<?php

namespace App\Http\Resources\V1\Singer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SingerIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "albums_count" => $this->albums()->count(),
            "created_at" => $this->created_at,
        ];
    }
}
