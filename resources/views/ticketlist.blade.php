@extends('layouts.app')

@section('content')



    <div class="container">
        <div class="row">
            @foreach($carvings as $carving)
                <div class="col-md-6">
                    <div class="contenido">
                        <div class="ticket">
                            <div class="hqr">
                                <div class="column left-one"></div>
                                <div class="column center">
                                    <div id="qrcode">Tag #{!! $carving->id !!}</div>
                                </div>
                                <div class="column right-one"></div>
                            </div>
                        </div>
                        <div class="details">
                            <div class="tinfo">
                                attendee
                            </div>
                            <div class="tdata name">
                                {!! $carving->fname !!} {!! $carving->lname !!}
                            </div>
                            <div class="tinfo">
                                Division
                            </div>
                            <div class="tdata">
                                {!! $carving->division !!}
                            </div>
                            <div class="tinfo">
                                Category
                            </div>
                            <div class="tdata">
                                {!! $carving->category !!}
                            </div>

                            <div class="tinfo">
                                Description
                            </div>

                            <div class="tdata">
                                {!! $carving->description !!}
                            </div>
                            <div class="masinfo">
                                <div class="left">
                                    <div class="tinfo">
                                        date
                                    </div>
                                    <div class="tdata nesp">
                                        6:00p.m. to 9:00 p.m.
                                    </div>
                                </div>
                                <div class="right">
                                    <div class="tinfo">
                                        location
                                    </div>
                                    <div class="tdata nesp">
                                        8980 Williams Road, Richmond, BC, Canada V7A 1G6
                                    </div>
                                </div>
                            </div>

                            <div class="link">
                                <a href="#">SEE MORE</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection