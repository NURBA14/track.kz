<?php

namespace App\Http\Resources\V1\Track;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TrackIndexResource extends JsonResource
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
            "album" => [
                "id" => $this->album->id,
                "name" => $this->album->name
            ],
            "singer" => [
                "id" => $this->album->singer->id,
                "name" => $this->album->singer->name 
            ],
            "created_at" => $this->created_at,
        ];
    }
}
