<?php

namespace Tests\Feature\Web\Admin\Track;

use App\Models\Album;
use App\Models\Singer;
use App\Models\Track;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class TrackTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_track_index(): void
    {
        $user = User::factory()->createOne([
            "is_admin" => 1
        ]);
        $response = $this->actingAs($user)->get(route("tracks.index"));
        $response->assertSee("Tracks");
        $response->assertViewIs("admin.track.index"); 
        $response->assertOk();
    }

    public function test_track_create(): void
    {
        $user = User::factory()->createOne([
            "is_admin" => 1
        ]);
        $response = $this->actingAs($user)->get(route("tracks.create"));
        $response->assertSee("Create Track");
        $response->assertViewIs("admin.track.create"); 
        $response->assertOk();
    }

    public function test_track_store(): void
    {
        $album = Album::factory()->for(Singer::factory())->createOne();
        $user = User::factory()->createOne([
            "is_admin" => 1
        ]);
        $track = UploadedFile::fake()->create("image.mp3");
        $response = $this->actingAs($user)->post(route("tracks.store"), [
            "name" => "Name",
            "album_id" => $album->id,
            "track" => $track,
        ]);
        $response->assertRedirectToRoute("tracks.index");
        $response->assertSessionHas("success", "Track is Saved");
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
    }

    public function test_track_edit(): void
    {
        $user = User::factory()->createOne([
            "is_admin" => 1
        ]);
        $fake_track = UploadedFile::fake()->create("image.mp3");
        $track = Track::factory()->for(Album::factory()->for(Singer::factory()))->createOne([
            "path" => $fake_track
        ]);
        $response = $this->actingAs($user)->get(route("tracks.edit", ["track" => $track->id]));
        $response->assertSee("Edit Track");
        $response->assertViewIs("admin.track.edit"); 
        $response->assertOk();
    }

    public function test_track_update(): void
    {
        $user = User::factory()->createOne([
            "is_admin" => 1
        ]);
        $fake_track = UploadedFile::fake()->create("image.mp3");
        $track = Track::factory()->for(Album::factory()->for(Singer::factory()))->createOne([
            "path" => $fake_track
        ]);
        $response = $this->actingAs($user)->put(route("tracks.update", ["track" => $track->id]), [
            "name" => "New name",
            "album_id" => $track->album->id,
            "track" => $fake_track
        ]);
        $response->assertRedirectToRoute("tracks.index");
        $response->assertSessionHas("success", "Track is Saved");
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
    }

    public function test_track_delete(): void
    {
        $user = User::factory()->createOne([
            "is_admin" => 1
        ]);
        $fake_track = UploadedFile::fake()->create("image.mp3");
        $track = Track::factory()->for(Album::factory()->for(Singer::factory()))->createOne([
            "path" => $fake_track
        ]);
        $response = $this->actingAs($user)->delete(route("tracks.destroy", ["track" => $track->id]));
        $response->assertRedirectToRoute("tracks.index");
        $response->assertSessionHas("success", "Track is deleted");
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
    }
}
