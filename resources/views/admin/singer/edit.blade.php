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
                <h4 class="card-title">Edit Singer</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-horizontal" action="{{ route('singers.update', ["singer" => $singer->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @method("PUT")
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="first-name-horizontal-icon">Singer Name</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Singer Name" id="first-name-horizontal-icon" value="{{ $singer->name }}">
                                            <div class="form-control-icon">
                                                <i class="bi bi-music-note-beamed"></i>
                                            </div>
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
