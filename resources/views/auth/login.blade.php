@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <a href="{{ url('/auth/redirect') }}" class="btn-google">Login with Google</a>
        </div>
    </div>
</div>
@endsection
