<?php

namespace App\Http\Resources\V1\Album;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AlbumIndexResource extends JsonResource
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
            "singer" => [
                "id" => $this->singer->id,
                "name" => $this->singer->name
            ],
            "img" => asset($this->getImage()),
            "tracks_count" => $this->tracks()->count(),
            "date" => $this->date,
            "created_at" => $this->created_at,
        ];
    }
}
