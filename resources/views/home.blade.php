@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xs-12 col-md-10">
                @include('carvingslist')
                @include('registercarvings')
            </div>
        </div>
    </div>
@endsection
