@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center" style="margin-bottom: 20px">
            <div class="col-xs-12 col-md-10">
                <div class="card" style="padding: 20px">
                    <h1>Online Registration</h1>
                    <ul>
                        <li>Entry must be received by May 27, 2021. - $8 per carving.</li>

                        <li><a href="http://richmondcarvers.com">Prospectus</a></li>
                        <li>Student carvings - n/c.</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xs-12 col-md-10">
                Pay
                <div id="paypal-button"></div>
            </div>
        </div>
    </div>
@endsection
