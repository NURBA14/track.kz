<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Singer;
use App\Models\Track;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $singers = Singer::count();
        $albums = Album::count();
        $tracks = Track::count();
        $popular_tracks = Track::orderBy("views", "DESC")->limit(5)->get();
        return view("admin.index", compact("singers", "albums", "tracks", "popular_tracks"));
    }
}
