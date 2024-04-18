<?php

namespace Tests\Feature\Api\V1\Album;

use App\Models\Album;
use App\Models\Singer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class AlbumDeleteTest extends TestCase
{
    use RefreshDatabase;
    protected static $album;
    public function setUp(): void
    {
        parent::setUp();
        self::$album = Album::factory()->for(Singer::factory())->createOne([
            "img" => UploadedFile::fake()->image("name.jpg")
        ]);
    }
    public function test_api_albums_delete(): void
    {
        $id = self::$album->id;
        $user = User::factory()->createOne([
            "is_admin" => 1
        ]);
        $response = $this->actingAs($user)->delete("/api/v1/albums/{$id}");
        $response->assertStatus(200);
    }
}
