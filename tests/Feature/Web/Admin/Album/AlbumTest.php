<?php

namespace Tests\Feature\Web\Admin\Album;

use App\Models\Album;
use App\Models\Singer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class AlbumTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_album_index(): void
    {
        $user = User::factory()->createOne([
            "is_admin" => 1
        ]);
        $response = $this->actingAs($user)->get(route("albums.index"));
        $response->assertSee("Albums");
        $response->assertViewIs("admin.album.index"); 
        $response->assertOk();
    }

    public function test_album_create(): void
    {
        $user = User::factory()->createOne([
            "is_admin" => 1
        ]);
        $response = $this->actingAs($user)->get(route("albums.create"));
        $response->assertSee("Create Album");
        $response->assertViewIs("admin.album.create"); 
        $response->assertOk();
    }

    public function test_album_store(): void
    {
        $singer = Singer::factory()->createOne();
        $user = User::factory()->createOne([
            "is_admin" => 1
        ]);
        $img = UploadedFile::fake()->image("image.jpg");
        $response = $this->actingAs($user)->withSession([
            '_token' => "wasd",
        ])->post(route("albums.store"), [
            '_token' => "wasd",
            "name" => "Name",
            "singer_id" => $singer->id,
            "img" => $img,
            "date" => date("Y-m-d")
        ]);
        $response->assertRedirectToRoute("albums.index");
        $response->assertSessionHas("success", "Album is saved");
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
    }

    public function test_album_edit(): void
    {
        $user = User::factory()->createOne([
            "is_admin" => 1
        ]);
        $album = Album::factory()->for(Singer::factory())->createOne();
        $response = $this->actingAs($user)->get(route("albums.edit", ["album" => $album->id]));
        $response->assertSee("Create Album");
        $response->assertViewIs("admin.album.edit"); 
        $response->assertOk();
    }

    public function test_album_update(): void
    {
        $user = User::factory()->createOne([
            "is_admin" => 1
        ]);
        $img = UploadedFile::fake()->image("image.jpg");
        $album = Album::factory()->for(Singer::factory())->createOne([
            "img" => $img
        ]);
        $response = $this->actingAs($user)->withSession([
            '_token' => "wasd",
        ])->put(route("albums.update", ["album" => $album->id]), [
            '_token' => "wasd",
            "name" => "Name",
            "singer_id" => $album->singer->id,
            "img" => $img,
            "date" => date("Y-m-d")
        ]);
        $response->assertRedirectToRoute("albums.index");
        $response->assertSessionHas("success", "Album is saved");
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
    }

    public function test_album_delete(): void
    {
        $user = User::factory()->createOne([
            "is_admin" => 1
        ]);
        $img = UploadedFile::fake()->image("image.jpg");
        $album = Album::factory()->for(Singer::factory())->createOne([
            "img" => $img
        ]);
        $response = $this->actingAs($user)->withSession([
            '_token' => "wasd",
        ])->delete(route("albums.destroy", [
            '_token' => "wasd",
            "album" => $album->id
        ]));
        $response->assertRedirectToRoute("albums.index");
        $response->assertSessionHas("success", "Album is deleted");
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
    }
}
