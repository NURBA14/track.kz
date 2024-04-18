@extends('client.layouts.layout')

@section('title')
    Track
@endsection

@section('header')
    Tracks
@endsection

@section('content')
    <div class="container">
        @include('admin.layouts.errors')
    </div>

    <div class="container">
        <div class="row">

            @isset($tracks)
                @foreach ($tracks as $track)
                    <div class="card">
                        <div class="card-content d-flex justify-content-between">
                            <img class="card-img-top img-fluid rounded-4 mt-2 mb-2" src="{{ asset($track->album->getImage()) }}"
                                alt="Card image cap" style="height: 150px; width: 150px">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a class="text-dark" href="{{ route('client.track.show', ['track' => $track->id]) }}">
                                        {{ $track->name }}
                                    </a>
                                </h4>
                                <p class="card-text">
                                    <a href="{{ route('client.album.show', ['album' => $track->album->id]) }}">
                                        {{ $track->album->name }}
                                    </a>
                                </p>
                                <a href="{{ route('client.track.download', ['track' => $track->id]) }}">
                                    <button class="btn btn-warning block">
                                        <i class="bi bi-download"></i>
                                        Download
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endisset
        </div>
        <div class="row">
            <div class="d-flex justify-content-center">
                @isset($tracks)
                    {{ $tracks->links() }}
                @endisset
            </div>
        </div>
    </div>
@endsection
