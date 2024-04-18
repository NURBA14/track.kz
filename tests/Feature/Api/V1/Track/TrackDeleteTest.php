<?php

namespace Tests\Feature\Api\V1\Track;

use App\Models\Album;
use App\Models\Singer;
use App\Models\Track;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class TrackDeleteTest extends TestCase
{
    use RefreshDatabase;
    protected static $track;
    public function setUp(): void
    {
        parent::setUp();
        self::$track = Track::factory()->for(Album::factory()->for(Singer::factory()))->createOne([
            "path" => UploadedFile::fake()->create("song.mp3")
        ]);
    }
    public function test_api_tracks_delete(): void
    {
        $id = self::$track->id;
        $user = User::factory()->createOne([
            "is_admin" => 1
        ]);
        $response = $this->actingAs($user)->delete("api/v1/tracks/{$id}");
        $response->assertJson([
            "message" => "success"
        ]);
        $response->assertStatus(200);
    }
}
