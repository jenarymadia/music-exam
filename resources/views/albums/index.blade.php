@extends('layouts.app')

@section('content')
    <album-view 
        :info="{{ json_encode($info) }}" 
    ></album-view>
@endsection
