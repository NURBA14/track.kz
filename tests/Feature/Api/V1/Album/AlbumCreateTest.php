<?php

namespace Tests\Feature\Api\V1\Album;

use App\Models\Singer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class AlbumCreateTest extends TestCase
{
    use RefreshDatabase;
    public function test_api_albums_create(): void
    {
        $user = User::factory()->createOne([
            "is_admin" => 1
        ]);
        $singer = Singer::factory()->createOne();
        $response = $this->actingAs($user)->post("/api/v1/albums", [
            "name" => "Album name",
            "singer_id" => $singer->id,
            "img" => UploadedFile::fake()->image("img.jpg"),
            "date" => date("Y-m-d")
        ]);
        $response->assertJsonStructure([
            "album" => [
                "id",
                "name",
                "img",
                "singer" => [
                    "id",
                    "name"
                ],
                "tracks_count",
                "tracks" => []
            ]
        ]);
        $response->assertStatus(201);
    }
}
