@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center" style="margin: 20px">
            <div class="col-xs-12 col-md-10">
                <div class="card" style="padding: 20px">
                    <h1>Online Registration</h1>
                    <ul>
                        <li>Entry must be received by May 28, 2020. - $6 per carving.</li>

                        <li><a href="http://richmondcarvers.com/2020-carving-show">Prospectus</a></li>
                        <li>Student carvings - n/c.</li>
                    </ul>

                    <h5>Tech support:</h5>
                    <ul>
                        <li><b>Mike Cohene</b> (604) 961-0063 <a href="mailto:mcohene@gmail.com">mcohene@gmail.com</a></li>
                        <li><b>Dave Price</b>  (778) 707-0057 <a href="dbp843@gmail.com">dbp843@gmail.com</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xs-12 col-md-10">
                @include('carvingslist')
                @include('registercarvings')
            </div>
        </div>
    </div>
@endsection
