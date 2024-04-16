<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Singer\SingerStoreRequest;
use App\Http\Requests\Web\Admin\Singer\SingerUpdateRequest;
use App\Models\Singer;
use Illuminate\Http\Request;

class SingerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $singers = Singer::with("albums")->orderBy("id", "DESC")->paginate(10);
        return view("admin.singer.index", compact("singers"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.singer.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SingerStoreRequest $request)
    {
        Singer::create([
            "name" => $request->validated("name")
        ]);
        return redirect()->route("singers.index")->with("success", "Singer is saved");
    }

    /**
     * Display the specified resource.
     */
    public function show(Singer $singer)
    {
        $singer->with("albums")->get();
        return view("admin.singer.show", compact("singer"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Singer $singer)
    {
        return view("admin.singer.edit", compact("singer"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SingerUpdateRequest $request, Singer $singer)
    {
        $singer->update([
            "name" => $request->validated("name")
        ]);
        return redirect()->route("singers.index")->with("success", "Singer is saved");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Singer $singer)
    {
        if ($singer->albums()->count()) {
            return redirect()->route("singers.index")->with("error", "This singer has albums");
        } else {
            $singer->delete();
            return redirect()->route("singers.index")->with("success", "Singer is deleted");
        }
    }
}
