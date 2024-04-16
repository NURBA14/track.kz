@extends('client.layouts.layout')

@section('title')
    Home
@endsection

@section('header')
    <div class="d-flex justify-content-between">
        Home
        <div class="col-md-4">
            <form action="{{ route('client.album.search') }}" method="GET">
                <div class="input-group mb-1">
                    <input type="text" class="form-control" placeholder="Album Name" aria-label="Recipient's username"
                        aria-describedby="button-addon2" name="search">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('content')
    <div class="container">
        @include("admin.layouts.success")
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
                                <a href="{{ route('client.album.show', ['album' => $album->id]) }}">
                                    <span class="text-dark">{{ $album->name }}</span>
                                </a>
                                <a href="{{ route('client.album.show', ['album' => $album->id]) }}">
                                    <button class="btn btn-light-danger"><i class="bi bi-play-fill"></i></button>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endisset
        </div>
        <div class="row">
            <div class="d-flex justify-content-center">
                @isset($albums)
                    {{ $albums->links() }}
                @endisset
            </div>
        </div>
    </div>
@endsection