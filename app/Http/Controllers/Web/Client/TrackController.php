<?php

namespace App\Http\Controllers\Web\Client;

use App\Http\Controllers\Controller;
use App\Models\Track;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrackController extends Controller
{
    public function index()
    {
        $tracks = Track::with("album")->orderBy("created_at", 'DESC')->paginate(6);
        return view("client.track.index", compact("tracks"));
    }
    public function show(Track $track)
    {
        return view("client.track.show", compact("track"));
    }

    public function download(Track $track)
    {
        return Storage::download($track->path);
    }
}
