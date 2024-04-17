<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\Singer;
use App\Models\Track;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Singer::factory(2)->create();
        Album::factory(2)->create();
        Track::factory(20)->create();
        User::factory(5)->create();
    }
}
