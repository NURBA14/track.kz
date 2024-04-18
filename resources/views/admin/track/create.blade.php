@extends('admin.layouts.layout')

@section('title')
    Singers
@endsection

@section('header')
@endsection

@section('content')
<div class="container">
    @include("admin.layouts.errors")
</div>    

<div class="container">
    <div class="col-md-8 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Create Track</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-horizontal" action="{{ route('tracks.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="first-name-horizontal-icon">Track Name</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Track Name" id="first-name-horizontal-icon" value="{{ old("name") }}">
                                            <div class="form-control-icon">
                                                <i class="bi bi-music-note-beamed"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="email-horizontal-icon">Album</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <select class="form-select" name="album_id" id="basicSelect">
                                                @if ($albums)
                                                    @foreach ($albums as $k => $v)
                                                        <option value="{{ $k }}">{{ $v }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="contact-info-horizontal-icon">Track</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <div class="position-relative">
                                            <input class="form-control" type="file" id="formFile" name="track">
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
</div>
@endsection
