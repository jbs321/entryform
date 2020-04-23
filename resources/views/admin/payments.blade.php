@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="card col-8 offset-2" style="padding:0;">
                <div class="payments" style="margin-bottom: 30px;">
                    <div class="card-header">
                        Payments History
                    </div>
                    <div class="card-body" style="overflow-y: scroll;min-height: 300px;padding: 0;">
                        <table class="table table-striped" style="margin: 0">
                            <thead>
                            <tr>
                                <th scope="col">Full Name</th>
                                <th scope="col">Number of Carvings</th>
                                <th scope="col">Price (CAD$)</th>
                                <th scope="col">Paid (CAD$)</th>
                                <th scope="col">Outstanding Payment (CAD$)</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th scope="row">{!! "$user->fname $user->lname" !!}</th>
                                    <td>{!! $user->carvings !!}</td>
                                    <td>{!! $user->price !!}</td>
                                    <td>{!! $user->paid !!}</td>
                                    <td style="color: {!! $user->outstanding > 0 ? "red" : "green" !!}">{!! $user->outstanding !!}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <th>Total</th>
                                <td><span style="font-weight: bold">{!! $totalCarvings !!}</span></td>
                                <td><span style="font-weight: bold">{!! $totalPrice !!}</span></td>
                                <td><span style="font-weight: bold">{!! $totalPaid !!}</span></td>
                                <td><span style="font-weight: bold; color: {!! $totalOutstanding > 0 ? "red" : "green" !!}">{!! $totalOutstanding !!}</span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
