@extends('admin.layouts.layout')

@section('title')
    Albums
@endsection

@section('header')
    Create Album
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
                        <h4 class="card-title">Create Album</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal" action="{{ route('albums.update', ['album' => $album->id]) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="first-name-horizontal-icon">Album name</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" name="name"
                                                        placeholder="Album name" id="first-name-horizontal-icon"
                                                        value="{{ $album->name }}">
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-music-note-beamed"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="email-horizontal-icon">Singer</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <select class="form-select" name="singer_id" id="basicSelect">
                                                        @if ($singers)
                                                            @foreach ($singers as $k => $v)
                                                                <option @if ($k == $album->singer->id) selected @endif
                                                                    value="{{ $k }}">{{ $v }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="contact-info-horizontal-icon">Album Image</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <div class="position-relative">
                                                    <input class="form-control" type="file" id="formFile"
                                                        name="img">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="password-horizontal-icon">Relis Date</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <div class="position-relative">
                                                    <input class="form-control" type="date" name="date"
                                                        value="{{ $album->date }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
