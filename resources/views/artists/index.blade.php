@extends('layouts.app')

@section('content')
    <artist-view 
        :artist="{{ json_encode($artist) }}" 
        :favorite="{{ $favorite }}" 
    ></artist-view>
@endsection
