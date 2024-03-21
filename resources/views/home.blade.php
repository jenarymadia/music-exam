@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <search-bar-component></search-bar-component>
                </div>

                <div class="card-body">
                    <search-results></search-results>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
