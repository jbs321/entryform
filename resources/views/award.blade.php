@extends('layouts.app')

@section('content')
    <div class="card container padding-0">
        <div class="card-header">Award Carving</div>
        <div class="card-body">
            <div class="row">
                <div class="col-3">
                    <img style="height: 100%; width: 100%;z-index: 10;"
                         src="https://bonathea.sirv.com/Images/{!! $photo->filename !!}">
                </div>
                <div class="row">
                    <div class="col-12">
                        <ul>
                            <li><b>Description</b>: {{$carving->description}}</li>
                            <li><b>Skill</b>: {{$carving->skill}}</li>
                            <li><b>Division</b>: {{$carving->division}}</li>
                            <li><b>Category</b>: {{$carving->category}}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <br/>

            <div class="container">
                <form method="post" action="/carving/{{$carving->id}}/award">
                    @csrf

                    @component('components.Select.award', compact('awards', 'selected'))
                    @endcomponent

                        <div class="row">
                            <div class="offset-5 col-2">
                                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                            </div>
                        </div>
                </form>

            </div>
        </div>
    </div>
@endsection