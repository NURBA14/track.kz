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
                        <h1 class="card-title">Album</h1>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-lg">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Name</th>
                                            <th>Views</th>
                                            <th>Player</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($album->tracks)
                                            @foreach ($album->tracks as $track)
                                                <tr>
                                                    <td>{{ $track->id }}</td>
                                                    <td>{{ $track->name }}</td>
                                                    <td>{{ $track->views }}</td>
                                                    <td style="width: 500px">
                                                        <div id="player/{{$track->id}}"></div>
                                                        <script>
                                                            var player = new Playerjs({
                                                                id: "player/{{$track->id}}",
                                                                file: "{{ asset($track->getTrack()) }}"
                                                            });
                                                        </script>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-start">
                    <img src="{{ asset($album->getImage()) }}" alt="">
                    <div class="card-body">
                        <h4 class="card-title">{{ $album->name }}</h4>
                        <p class="card-text">{{ $album->singer->name }}</p>
                        <p class="card-text">{{ $album->date }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
