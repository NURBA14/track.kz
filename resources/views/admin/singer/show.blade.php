@extends('admin.layouts.layout')

@section('title')
    Albums
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
                    <div class="card-header">
                        <h1 class="card-title">{{ $singer->name }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @if ($singer->albums()->count())
                @foreach ($singer->albums as $album)
                    <div class="col-md-4">
                        <div class="card text-start">
                            <img src="{{ asset($album->getImage()) }}" alt="">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="{{ route("albums.show", ["album" => $album->id]) }}">
                                        {{ $album->name }}
                                    </a>
                                </h4>
                                <p class="card-text">{{ $album->singer->name }}</p>
                                <p class="card-text">{{ $album->date }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>
    </div>
@endsection
