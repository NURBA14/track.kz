@extends('admin.layouts.layout')

@section('title')
    Albums
@endsection

@section('header')
@endsection

@section('content')
    <div class="container">
        @include('admin.layouts.success')
        @include('admin.layouts.error')
    </div>
    <div class="container">
        <div class="row" id="table-bordered">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            Tracks
                        </h4>
                    </div>
                    <div class="card-content">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Name</th>
                                        <th>Views</th>
                                        <th>Singer</th>
                                        <th>Album</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($tracks)
                                        @foreach ($tracks as $track)
                                            <tr>
                                                <td>{{ $track->id }}</td>
                                                <td>
                                                    <a href="{{ route('tracks.show', ['track' => $track->id]) }}">
                                                        {{ $track->name }}
                                                    </a>
                                                </td>
                                                <td>{{ $track->views }}</td>
                                                <td>
                                                    <a
                                                        href="{{ route('singers.show', ['singer' => $track->album->singer->id]) }}">
                                                        {{ $track->album->singer->name }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('albums.show', ['album' => $track->album->id]) }}">
                                                        {{ $track->album->name }}
                                                    </a>
                                                </td>
                                                <td>{{ Str::limit($track->created_at, 10, '') }}</td>
                                                <td>
                                                    <a href="{{ route('tracks.edit', ['track' => $track->id]) }}">
                                                        <button class="btn btn-warning">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </button>
                                                    </a>
                                                    <form action="{{ route('tracks.destroy', ['track' => $track->id]) }}"
                                                        method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button class="btn btn-danger"
                                                            onclick="return confirm('Delete track?')" type="submit">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        @isset($track)
                            {{ $tracks->links() }}
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
