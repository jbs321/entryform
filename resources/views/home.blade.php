@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center" style="margin: 20px">
            <div class="col-xs-12 col-md-10">
                <div class="card" style="padding: 20px">
                    <h1>Online Registration</h1>
                    <ul>
                        <li>Pre-paid and pre-registered entries received by May 18th, 2018 - $6.00/carving for first 4, 5th
                            plus n/c.</li>

                        <li>Entry fee on registration days as per <a href="http://richmondcarvers.com/wp-content/uploads/2018/04/Prospectus-2018-1.pdf">Prospectus</a> - $10.00/carving for first 4, 5th plus n/c.</li>
                        <li>Total price displayed will be paid at the door.</li>
                        <li>Student carvings - n/c.</li>
                        <li>Courtesy carvings - n/c.</li>
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
