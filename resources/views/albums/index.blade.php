@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-between mb-3">
        <div class="col-auto">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
        </div>
        <div class="col-auto">
            <button class="btn btn-primary">Add to Favorites</button>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>{{ $album['name'] }}</h1>
            <img src="{{ $album['image']['large'] }}" alt="{{ $album['name'] }}" class="img-fluid rounded mb-3">
            <h2>Tracks:</h2>
            <ul class="list">
                @foreach ($album['tracks'] as $track)
                    <li class="list">
                        <a href="{{ $track['url'] }}">{{ $track['name'] }}</a>
                    </li>
                @endforeach
            </ul>

            <h2>Tags:</h2>
            <ul class="list-inline">
                @foreach ($album['toptags'] as $tag)
                    <li class="list-inline-item"><a href="{{ $tag['url'] }}" class="badge badge-primary">{{ $tag['name'] }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
