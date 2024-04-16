<?php

namespace App\Http\Controllers\Web\Client;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $albums = Album::with("singer", "tracks")->orderBy("created_at", "DESC")->paginate(12);
        return view("client.index", compact("albums"));
    }
}
