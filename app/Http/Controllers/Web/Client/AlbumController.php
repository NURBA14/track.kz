<?php

namespace App\Http\Controllers\Web\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Client\Album\AlbumSearchRequest;
use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{

    public function search(AlbumSearchRequest $request)
    {
        $s = $request->validated("search");
        $albums = Album::with("singer", "tracks")->where("name", "LIKE", "%{$s}%")->orderBy("created_at", "DESC")->get();
        return view("client.album.search", compact("albums"));
    }
    public function show(Album $album)
    {
        return view("client.album.show", compact("album"));   
    }
}
