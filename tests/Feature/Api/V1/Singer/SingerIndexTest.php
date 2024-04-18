<?php

namespace Tests\Feature\Api\V1\Singer;

use App\Models\Album;
use App\Models\Singer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SingerIndexTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Singer::factory(10)->has(Album::factory(3))->create();
    }
    /**
     * A basic feature test example.
     */
    public function test_api_singers_index(): void
    {
        $response = $this->get("api/v1/singers");
        $response->assertJsonStructure([
            "singers" => [
                "*" => [
                    "id",
                    "name",
                    "albums_count",
                    "created_at"
                ]
            ]
        ]);
        $response->assertOk();
    }
}
