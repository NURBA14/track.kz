<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Album\AlbumStoreRequest;
use App\Http\Requests\Api\V1\Album\AlbumUpdateRequest;
use App\Http\Resources\V1\Album\AlbumIndexResource;
use App\Http\Resources\V1\Album\AlbumShowResource;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
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
        return response()->json(["albums" => AlbumIndexResource::collection(Album::orderBy("created_at", "DESC")->get())]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AlbumStoreRequest $request)
    {
        $date = $request->validated("date");
        $img = $request->file("img")->store("images/{$date}");
        $album = Album::create([
            "name" => $request->validated("name"),
            "singer_id" => $request->validated("singer_id"),
            "date" => $request->validated("date"),
            "img" => $img
        ]);
        return response()->json(["album" => new AlbumShowResource($album)], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Album $album)
    {
        return response()->json(["album" => new AlbumShowResource($album)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AlbumUpdateRequest $request, Album $album)
    {
        $album->update([
            "name" => $request->validated("name"),
            "singer_id" => $request->validated("singer_id"),
            "date" => $request->validated("date"),
        ]);
        return response()->json(["album" => new AlbumShowResource($album)]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        if ($album->tracks()->count()) {
            return response()->json(["message" => "This album has tracks"]);
        } else {
            Storage::delete($album->img);
            $album->delete();
            return response()->json(["message" => "success"]);
        }
    }
}
