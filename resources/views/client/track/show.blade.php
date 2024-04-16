@extends('client.layouts.layout')

@section('title')
    Track
@endsection

@section('header')
@endsection

@section('content')
    <div class="container">
        @include('admin.layouts.errors')
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <h1 class="card-title">{{ $track->name }}</h1>
                            <h4 class="card-text">{{ $track->views }} Views</h4>
                            <br>
                            <div id="player"></div>
                            <script>
                                var player = new Playerjs({
                                    id: "player",
                                    file: "{{ asset($track->getTrack()) }}"
                                });
                            </script>
                            <br>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('client.track.download', ['track' => $track->id]) }}">
                                    <button class="btn btn-warning">
                                        <i class="bi bi-download"></i>
                                        Download
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-start">
                    <img src="{{ asset($track->album->getImage()) }}" alt="">
                    <div class="card-body">
                        <h4 class="card-title">{{ $track->album->name }}</h4>
                        <p class="card-text">{{ $track->album->singer->name }}</p>
                        <p class="card-text">{{ $track->album->date }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
