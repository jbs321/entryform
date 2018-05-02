@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card" style="margin-bottom: 30px;">
                    <div class="card-header">Admin Dashboard</div>
                    <div class="card-body" style="padding: 0;">
                        <table class="table table-striped" style="margin: 0">
                            <thead>
                            <tr>
                                <th scope="col">Tag Number</th>
                                <th scope="col">Full Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>

                                <th scope="col">Skill Level</th>
                                <th scope="col">Division</th>
                                <th scope="col">Category</th>
                                <th scope="col">Description</th>
                                <th scope="col">For Sale?</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($carvings as $carving)
                                <tr>
                                    <td scope="row">{!! $carving->id !!}</td>
                                    <td scope="row">{!! $carving->user->fname !!} {!! $carving->user->lname !!}</td>
                                    <td scope="row">{!! $carving->user->email !!}</td>
                                    <td scope="row">{!! $carving->phone_number !!}</td>
                                    <td>{!! $carving->skill !!}</td>
                                    <td>{!! $carving->division !!}</td>
                                    <td>{!! $carving->category !!}</td>
                                    <td>{!! $carving->description !!}</td>
                                    <td>{!! $carving->is_for_sale ? "Yes" : "No" !!}</td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
