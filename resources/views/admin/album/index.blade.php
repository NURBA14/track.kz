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
                            Albums
                        </h4>
                    </div>
                    <div class="card-content">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Name</th>
                                        <th>Singer</th>
                                        <th>Tracks</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($albums)
                                        @foreach ($albums as $album)
                                            <tr>
                                                <td>{{ $album->id }}</td>
                                                <td>
                                                    <a href="{{ route('albums.show', ['album' => $album->id]) }}">
                                                        {{ $album->name }}
                                                    </a>
                                                </td>
                                                <td>{{ $album->singer->name }}</td>
                                                <td>{{ $album->tracks()->count() }}</td>
                                                <td>{{ $album->date }}</td>
                                                <td>
                                                    <a href="{{ route('albums.edit', ['album' => $album->id]) }}">
                                                        <button class="btn btn-warning">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </button>
                                                    </a>
                                                    <form action="{{ route('albums.destroy', ['album' => $album->id]) }}"
                                                        method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button class="btn btn-danger"
                                                            onclick="return confirm('Delete album?')" type="submit">
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
                        @isset($albums)
                            {{ $albums->links() }}
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
