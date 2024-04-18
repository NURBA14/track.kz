<?php

namespace Tests\Feature\Api\V1\Track;

use App\Models\Album;
use App\Models\Singer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class TrackCreateTest extends TestCase
{
    use RefreshDatabase;
    public function test_api_tracks_create(): void
    {
        $user = User::factory()->createOne([
            "is_admin" => 1
        ]);
        $album = Album::factory()->for(Singer::factory())->createOne();
        $response = $this->actingAs($user)->post("/api/v1/tracks", [
            "name" => "Track Name",
            "album_id" => $album->id,
            "track" => UploadedFile::fake()->create("song.mp3")
        ]);
        $response->assertJsonStructure([
            "track" => [
                "id",
                "name",
                "track",
                "views",
                "album" => [
                    "id",
                    "name"
                ],
                "singer" => [
                    "id",
                    "name"
                ],
                "created_at"
            ]
        ]);
        $response->assertOk();
    }
}
