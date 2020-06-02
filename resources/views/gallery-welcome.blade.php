@extends('layouts.minimal')

@section('content')
    <div class="container-fluid" style="height: 100%">
        <div class="row padding-left-20">
            <div class="col-12" style="float: left;margin-top: 100px;height: 100px">
                <h1>Richmond Carvers</h1>
                <h2>Virtual Carving Show 2020</h2>
            </div>

            <div class="col-12 margin-top-100 vw-1-6">
                <div>Over {{$carvings}} Carvings</div>
                <div>Over {{$carvers}} Artists</div>
            </div>
            <div class="col-12 margin-top-60">
                <button class="btn btn-1 btn-1a" onclick="goToGallery()">Gallery</button>
            </div>
        </div>
        <div class="me">
            Built by <a href="mailto:jacob@balabanov.ca"><b>Jacob Balabanov</b></a>
            <a href="tel:+17788820853">(+1 778-882-0853)</a>
        </div>
    </div>
    <script>
      function goToGallery () {
        location.href = '/gallery'
      }
    </script>

@endsection
