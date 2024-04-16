@extends('admin.layouts.layout')

@section('title')
    Home
@endsection

@section('header')
    Home
@endsection

@section('content')
    <div class="container">
        <div class="row">

            @isset($singers)
                <div class="col-md-3">
                    <div class="card bg-success">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <button class="btn btn-xl btn-light rounded-4">
                                        <i class="bi bi-person-square"></i>
                                    </button>
                                </div>
                                <div class="text-dark col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text font-extrabold">Singers</h6>
                                    <h6 class="font-semibold mb-0">{{ $singers }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endisset

            @isset($albums)
                <div class="col-md-3">
                    <div class="card bg-info">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <button class="btn btn-xl btn-light rounded-4">
                                        <i class="bi bi-music-note-list"></i>
                                    </button>
                                </div>
                                <div class="text-dark col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text font-extrabold">Albums</h6>
                                    <h6 class="font-semibold mb-0">{{ $albums }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endisset

            @isset($tracks)
                <div class="col-md-3">
                    <div class="card bg-warning ">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <button class="btn btn-xl btn-light rounded-4">
                                        <i class="bi bi-file-music"></i>
                                    </button>
                                </div>
                                <div class="text-dark col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text font-extrabold">Tracks</h6>
                                    <h6 class="font-semibold mb-0">{{ $tracks }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endisset

        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                @isset($popular_tracks)
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">The most popular tracks</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-lg">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Album</th>
                                                <th>Views</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($popular_tracks as $track)
                                                <tr>
                                                    <td>{{ $track->id }}</td>
                                                    <td>
                                                        <a href="{{ route("tracks.show", ["track" => $track->id]) }}">
                                                            {{ $track->name }}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route("albums.show", ["album" => $track->album->id]) }}">
                                                            {{ $track->album->name }}
                                                        </a>
                                                    </td>
                                                    <td>{{ $track->views }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endisset
            </div>
        </div>
    </div>
@endsection
