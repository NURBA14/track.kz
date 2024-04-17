<?php

namespace App\Http\Resources\V1\Album;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AlbumShowResource extends JsonResource
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
            "img" => asset($this->getImage()),
            "singer" => [
                "id" => $this->singer->id,
                "name" => $this->singer->name
            ],
            "tracks_count" => $this->tracks()->count(),
            "tracks" => AlbumTracksListResource::collection($this->tracks),
            "date" => $this->date,
            "created_at" => $this->created_at,
        ];
    }
}
