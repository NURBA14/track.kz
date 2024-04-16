@extends('client.layouts.layout')

@section('title')
    Search Album
@endsection

@section('header')
    <div class="d-flex justify-content-between">
        Search Album {{ request()->search }}
        <a href="{{ route("client.home") }}">
            <button class="btn btn-outline-primary" type="button" id="button-addon2">
                <i class="bi bi-house-fill"></i>                
                Back
            </button>
        </a>
    </div>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            @isset($albums)
                @foreach ($albums as $album)
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <img class="img-fluid rounded-4" src="{{ asset($album->getImage()) }}" alt="Card image cap"
                                        style="
                                        width: 200px; 
                                        height: 200px;
                                        ">
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <span>{{ $album->name }}</span>
                                <a href="{{ route('client.album.show', ['album' => $album->id]) }}">
                                    <button class="btn btn-light-danger"><i class="bi bi-play-fill"></i></button>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endisset
        </div>
    </div>
@endsection
