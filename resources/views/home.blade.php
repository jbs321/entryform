@extends('layouts.app')@section('content')
    <div class="container">
        <div class="row justify-content-center" style="margin-bottom: 20px">
            <div class="col-xs-12 col-md-10">
                <div class="card" style="padding: 20px">
                    @if (\Illuminate\Support\Facades\Auth::user()->is_admin)
                        <form method="POST" action="/note">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <div class="form-group">
                                    <textarea class="form-control summernote" name="note" id="note">{{$note}}</textarea>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    @else
                        {!! $note !!}
                    @endif
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
    <script>
      $(document).ready(function () {
        $('#note').summernote({});
      });
    </script>
@endsection
