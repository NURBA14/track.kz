@extends('admin.layouts.layout')

@section('title')
    Singers
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
                            Singers
                        </h4>
                    </div>
                    <div class="card-content">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Name</th>
                                        <th>Albums</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($singers)
                                        @foreach ($singers as $singer)
                                            <tr>
                                                <td>{{ $singer->id }}</td>
                                                <td>
                                                    <a href="{{ route("singers.show", ["singer" => $singer->id]) }}">
                                                        {{ $singer->name }}
                                                    </a>
                                                </td>
                                                <td>{{ $singer->albums()->count() }}</td>
                                                <td>{{ Str::limit($singer->created_at, 10, '') }}</td>
                                                <td>
                                                    <a href="{{ route('singers.edit', ['singer' => $singer->id]) }}">
                                                        <button class="btn btn-warning">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </button>
                                                    </a>
                                                    <form action="{{ route('singers.destroy', ['singer' => $singer->id]) }}"
                                                        method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button class="btn btn-danger"
                                                            onclick="return confirm('Delete singer?')" type="submit">
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
                        @isset($singers)
                            {{ $singers->links() }}
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
