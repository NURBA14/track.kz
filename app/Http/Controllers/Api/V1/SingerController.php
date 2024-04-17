<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Singer\SingerStoreRequest;
use App\Http\Requests\Api\V1\Singer\SingerUpdateRequest;
use App\Http\Resources\V1\Singer\SingerIndexResource;
use App\Http\Resources\V1\Singer\SingerShowResource;
use App\Models\Singer;
use Illuminate\Http\Request;

class SingerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(["singers" => SingerIndexResource::collection(Singer::orderBy("created_at", "DESC")->get())]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SingerStoreRequest $request)
    {
        $singer = Singer::create([
            "name" => $request->validated("name")
        ]);
        return response()->json(["singer" => new SingerShowResource($singer)], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Singer $singer)
    {
        return response()->json(["singer" => new SingerShowResource($singer)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SingerUpdateRequest $request, Singer $singer)
    {
        $singer->update([
            "name" => $request->validated("name")
        ]);
        return response()->json(["singer" => new SingerShowResource($singer)]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Singer $singer)
    {
        if ($singer->albums()->count()) {
            return response()->json(["message" => "This singer has albums"]);
        } else {
            $singer->delete();
            return response()->json(["message" => "success"]);
        }
    }
}
