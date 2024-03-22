@extends('layouts.app')

@section('content')
    <artist-view 
        :info="{{ json_encode($info) }}" 
        :tracks="{{ json_encode($tracks) }}" 
        :albums="{{ json_encode($albums) }}" 
        :favorite="{{ $favorite }}" 
    ></artist-view>
@endsection
