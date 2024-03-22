@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                </div>

                <div class="card-body">
                    <search-results
                        :favoriteartists = "{{ json_encode($favoriteArtists) }}"
                        :favoritealbums ="{{ json_encode($favoriteAlbums) }}"
                    ></search-results>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
