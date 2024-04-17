<?php

namespace App\Http\Resources\V1\Album;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AlbumTracksListResource extends JsonResource
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
            "track" => asset($this->getTrack()),
            "views" => $this->views,
            "album" => $this->album->name,
            "created_at" => $this->created_at,
        ];
    }
}
