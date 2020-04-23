@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="card col-6 offset-3" style="padding:0">
                <div class="payments" style="margin-bottom: 30px;">
                    <div class="card-header">
                        Payments History
                    </div>
                    <div class="card-body" style="overflow-y: scroll;height: 300px;padding: 0;">
                        <table class="table table-striped" style="margin: 0">
                            <thead>
                            <tr>
                                <th scope="col">Payment Date</th>
                                <th scope="col">Amount (CAD$)</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($payments as $payment)
                                <tr>
                                    <th scope="row">{!! $payment->created_at->format('d/m/Y') !!}</th>
                                    <td>${!! $payment->amount !!}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <th>Total</th>
                                <td><span style="font-weight: bold">${!! $totalPaid !!}</span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
