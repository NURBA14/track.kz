<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Track\TrackStoreRequest;
use App\Http\Requests\Api\V1\Track\TrackUpdateRequest;
use App\Http\Resources\V1\Track\TrackIndexResource;
use App\Http\Resources\V1\Track\TrackShowResource;
use App\Models\Track;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrackController extends Controller
{
    public function __construct()
    {
        $this->middleware(["auth:sanctum", "api_admin"])->only("store", "update", "destroy");
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(["tracks" => TrackIndexResource::collection(Track::orderBy("created_at", "DESC")->get())]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TrackStoreRequest $request)
    {
        $date = date("Y-m-d");
        $path = $request->file("track")->store("tracks/{$date}");
        $track = Track::create([
            "name" => $request->validated("name"),
            "album_id" => $request->validated("album_id"),
            "path" => $path
        ]);
        return response()->json(["track" => new TrackShowResource($track)]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Track $track)
    {
        return response()->json(["track" => new TrackShowResource($track)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TrackUpdateRequest $request, Track $track)
    {
        $track->update([
            "name" => $request->validated("name"),
            "album_id" => $request->validated("album_id"),
        ]);
        return response()->json(["track" => new TrackShowResource($track)]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Track $track)
    {
        Storage::delete($track->path);
        $track->delete();
        return response()->json(["message" => "success"]);
    }
}
