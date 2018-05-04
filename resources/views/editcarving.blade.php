@extends('layouts.app')

@section('content')
    <div class="card container" style="padding: 0">
        <div class="card-header">Edit Carving</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="/carving/{{ $carving->id }}/update" method="POST">
                @csrf

                <div class="form-group row">
                    <label for="skill" class="col-md-4 col-form-label text-md-right">{{ __('Skill Level') }}</label>

                    <div class="col-md-6">
                        {!! Form::select('skill', [
                               "Student"      => "Student",
                               "Novice"       => "Novice",
                               "Intermediate" => "Intermediate",
                               "Advanced"     => "Advanced",
                               "Expert"       => "Expert",
                        ], $carving->skill,  [
                            "id"            => "skill",
                            "required"      => "required",
                            "autofocus"     => "autofocus",
                            "class"         => "form-control " . $errors->has('skill') ? ' is-invalid' : '',
                        ])!!}
                        @if ($errors->has('skill'))
                            <span class="invalid-feedback"><strong>{{ $errors->first('skill') }}</strong></span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="division" class="col-md-4 col-form-label text-md-right">{{ __('Division') }}</label>

                    <div class="col-md-6">
                        {!! Form::select('division', \App\Http\Controllers\CarvingController::DIVISIONS, $carving->division,  [
                            "id"            => "division",
                            "required"      => "required",
                            "autofocus"     => "autofocus",
                            "onchange"      => "onChangeDivision(this)",
                            "class"         => "form-control " . $errors->has('division') ? ' is-invalid' : '',
                        ])!!}
                        @if ($errors->has('division'))
                            <span class="invalid-feedback"><strong>{{ $errors->first('division') }}</strong></span>
                        @endif
                    </div>
                </div>


                <div class="form-group row">
                    <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>

                    <div class="col-md-6">

                        {{$isValid = $errors->has('category') ? ' is-invalid' : ''}}

                        <select name="category"
                                id="category"
                                required
                                autofocus
                                value="{{$carving->category}}"
                                style="padding: 0;"
                                class={{"col-md-12 form-control " . $isValid}}>

                            @foreach(\App\Http\Controllers\CarvingController::CATEGORIES as $division => $categories)
                                @foreach($categories as $id => $category)
                                    <option value="{!! $id !!}"
                                            division="{{$division}}"
                                            title="{{$division}}"
                                    >{!! "$id - $category" !!}</option>
                                @endforeach
                            @endforeach
                        </select>

                        @if ($errors->has('category'))
                            <span class="invalid-feedback"><strong>{{ $errors->first('category') }}</strong></span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

                    <div class="col-md-6">
            <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                      name="description" autofocus
                      placeholder="Description of carving and type of wood or other media" rows="6">{{ $carving->description }}</textarea>

                        @if ($errors->has('description'))
                            <span class="invalid-feedback"><strong>{{ $errors->first('description') }}</strong></span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="division" class="col-md-4 col-form-label text-md-right">{{ __('Is For Sale?') }}</label>

                    <div class="col-md-6">
                        {!! Form::select('is_for_sale', [
                            0 => "no",
                            1 => "yes",
                        ], $carving->is_for_sale,  [
                            "id"            => "is_for_sale",
                            "required"      => "required",
                            "autofocus"     => "autofocus",
                            "class"         => "form-control " . $errors->has('is_for_sale') ? ' is-invalid' : '',
                        ])!!}
                        @if ($errors->has('is_for_sale'))
                            <span class="invalid-feedback"><strong>{{ $errors->first('is_for_sale') }}</strong></span>
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary" id="submit-carving">
                            {{ __('Save Changes') }}
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <script>
        function onChangeDivision() {
            var division = $("#division").val();

            $('#category').children().hide();
            $('#category option[division="' + division + '"]').show();
            $('#category').val($('#category option[division="' + division + '"]').first().val());

        }

        $(function () {
            onChangeDivision();
            $("select#category option[value={{$carving->category}}]").prop('selected', true);

            $('#submit-carving').on('click', function (event) {
                alert("Changes Saved Successfully!");
            });
        });
    </script>
@endsection