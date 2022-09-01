@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center" style="margin: 20px">
            <div class="col-xs-12 col-md-10">
                <div class="card" style="padding: 20px">
                    <h1>Online Registration</h1>
                    <ul>
                        <li>Entry must be received by May 27, 2021. - $8 per carving.</li>

                        <li><a href="https://www.richmondcarvers.com/_files/ugd/00231c_f6ba2a9604ba4ce3b365d3309f3c092d.pdf">Prospectus</a></li>
                        <li>Student carvings - n/c.</li>
                    </ul>

                    <h5>Tech support:</h5>
                    <ul>
                        <li><b>Mike Cohene</b> (604) 961-0063 <a href="mailto:mcohene@gmail.com">mcohene@gmail.com</a>
                        </li>
                        <li><b>Dave Price</b> (778) 707-0057 <a href="dbp843@gmail.com">dbp843@gmail.com</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xs-12 col-md-10">
                @include('carvingslist')
                @if( env('ENTRYFORM_REGISTRATION', 1) || \Illuminate\Support\Facades\Auth::user()->is_admin)
                    @include('registercarvings')
                @endif
            </div>
        </div>
    </div>
@endsection
