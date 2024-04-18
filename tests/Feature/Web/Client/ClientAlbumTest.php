<?php

namespace Tests\Feature\Web\Client;

use App\Models\Album;
use App\Models\Singer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClientAlbumTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_client_album_search(): void
    {
        $response = $this->get(route("client.album.search", ["search" => "Album"]));
        $response->assertSee("Search Album Album");
        $response->assertViewIs("client.album.search");
        $response->assertOk();
    }

    public function test_client_album_show()
    {
        $album = Album::factory()->for(Singer::factory())->createOne();
        $response = $this->get(route("client.album.show", ["album" => $album->id]));
        $response->assertSee($album->name);
        $response->assertViewIs("client.album.show");
        $response->assertOk();
    }
}
