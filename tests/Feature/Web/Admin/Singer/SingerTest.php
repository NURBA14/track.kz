<?php

namespace Tests\Feature\Web\Admin\Singer;

use App\Models\Singer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SingerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_singers_index(): void
    {
        $user = User::factory()->createOne([
            "is_admin" => 1
        ]);
        $response = $this->actingAs($user)->get(route("singers.index"));
        $response->assertSee("Singers");
        $response->assertViewIs("admin.singer.index"); 
        $response->assertOk();
    }


    public function test_singer_create(): void
    {
        $user = User::factory()->createOne([
            "is_admin" => 1
        ]);
        $response = $this->actingAs($user)->get(route("singers.create"));
        $response->assertSee("Create Singer");
        $response->assertViewIs("admin.singer.create"); 
        $response->assertOk();
    }

    public function test_singer_store(): void
    {
        $user = User::factory()->createOne([
            "is_admin" => 1
        ]);
        $response = $this->actingAs($user)
        ->withSession([
            '_token' => "wasd",
        ])->post(route("singers.store"), [
            '_token' => "wasd",
            "name" => "Singer"
        ]);
        $response->assertRedirectToRoute("singers.index");
        $response->assertSessionHas("success", "Singer is saved");
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
    }


    public function test_singer_edit(): void
    {
        $user = User::factory()->createOne([
            "is_admin" => 1
        ]);
        $singer = Singer::factory()->createOne();
        $response = $this->actingAs($user)->get(route("singers.edit", ["singer" => $singer->id]));
        $response->assertOk();
    }

    public function test_singer_update(): void
    {
        $user = User::factory()->createOne([
            "is_admin" => 1
        ]);
        $singer = Singer::factory()->createOne();
        $response = $this->actingAs($user)
        ->withSession([
            '_token' => "wasd",
        ])->put(route("singers.update", ["singer" => $singer->id]), [
            '_token' => "wasd",
            "name" => "Singer name"
        ]);
        $response->assertRedirectToRoute("singers.index");
        $response->assertSessionHas("success", "Singer is saved");
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
    }


    public function test_singer_delete(): void
    {
        $user = User::factory()->createOne([
            "is_admin" => 1
        ]);
        $singer = Singer::factory()->createOne();
        $response = $this->actingAs($user)
        ->withSession([
            '_token' => "wasd",
        ])->delete(route("singers.destroy", [
            '_token' => "wasd",
            "singer" => $singer->id
        ]));
        $response->assertRedirectToRoute("singers.index");
        $response->assertSessionHas("success", "Singer is deleted");
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
    }
}
