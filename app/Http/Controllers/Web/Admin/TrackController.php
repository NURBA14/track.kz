<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Track\TrackStoreRequest;
use App\Http\Requests\Web\Admin\Track\TrackUpdateRequest;
use App\Models\Album;
use App\Models\Track;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tracks = Track::with("album")->orderBy("id", "DESC")->paginate(10);
        return view("admin.track.index", compact("tracks"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $albums = Album::pluck("name", "id");
        return view("admin.track.create", compact("albums"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TrackStoreRequest $request)
    {
        $date = date("Y-m-d");
        $path = $request->file("track")->store("tracks/{$date}");
        Track::create([
            "name" => $request->validated("name"),
            "album_id" => $request->validated("album_id"),
            "path" => $path
        ]);
        return redirect()->route("tracks.index")->with("success", "Track is Saved");
    }

    /**
     * Display the specified resource.
     */
    public function show(Track $track)
    {
        return view("admin.track.show", compact("track"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Track $track)
    {
        $albums = Album::pluck("name", "id");
        return view("admin.track.edit", compact("albums", "track"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TrackUpdateRequest $request, Track $track)
    {
        Storage::delete($track->path);
        $date = date("Y-m-d");
        $path = $request->file("track")->store("tracks/{$date}");
        $track->update([
            "name" => $request->validated("name"),
            "album_id" => $request->validated("album_id"),
            "path" => $path
        ]);
        return redirect()->route("tracks.index")->with("success", "Track is Saved");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Track $track)
    {
        Storage::delete($track->path);
        $track->delete();
        return redirect()->route("tracks.index")->with("success", "Track is deleted");
    }
}
