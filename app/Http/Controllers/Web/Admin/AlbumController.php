<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Album\AlbumStoreRequest;
use App\Http\Requests\Web\Admin\Album\AlbumUpdateRequest;
use App\Models\Album;
use App\Models\Singer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $albums = Album::with("tracks", "singer")->orderBy("date", "DESC")->paginate(10);
        return view("admin.album.index", compact("albums"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $singers = Singer::pluck("name", "id");
        return view("admin.album.create", compact("singers"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AlbumStoreRequest $request)
    {
        $date = $request->validated("date");
        $img = $request->file("img")->store("images/{$date}");
        Album::create([
            "name" => $request->validated("name"),
            "singer_id" => $request->validated("singer_id"),
            "date" => $request->validated("date"),
            "img" => $img
        ]);
        return redirect()->route("albums.index")->with("success", "Album is saved");
    }

    /**
     * Display the specified resource.
     */
    public function show(Album $album)
    {
        return view("admin.album.show", compact("album"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album)
    {
        $album->with("tracks")->get();
        $singers = Singer::pluck("name", "id");
        return view("admin.album.edit", compact("album", "singers"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AlbumUpdateRequest $request, Album $album)
    {
        Storage::delete($album->img);
        $date = $request->validated("date");
        $img = $request->file("img")->store("images/{$date}");
        $album->update([
            "name" => $request->validated("name"),
            "singer_id" => $request->validated("singer_id"),
            "date" => $request->validated("date"),
            "img" => $img
        ]);
        return redirect()->route("albums.index")->with("success", "Album is saved");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        if ($album->tracks()->count()) {
            return redirect()->route("albums.index")->with("error", "This album has tracks");
        } else {
            Storage::delete($album->img);
            $album->delete();
            return redirect()->route("albums.index")->with("success", "Album is deleted");
        }
    }
}
