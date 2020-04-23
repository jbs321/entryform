@extends('layouts.app')

@section('content')

    <?php
    $user = \Illuminate\Support\Facades\Auth::user();
    $fullName = "$user->fname $user->lname";
    $email = "$user->email";
    $link = "https://docs.google.com/forms/d/e/1FAIpQLSd2pFqE9YzyUf50jJA7nGvYEggnSH6_ziJYAnlBjRiXGDgTlg/viewform?usp=pp_url&entry.199823495=full_name&entry.1383365882=carving_tag_number&entry.1373471256=email&entry.271632587=skill&entry.1311842077=division&entry.1137483383=category";
    $link = str_replace("full_name", $fullName, $link);
    $link = str_replace("email", $user->email, $link);
    $link = str_replace("carving_tag_number", "$carvingId", $link);
    $link = str_replace("skill", $carving->skill, $link);
    $link = str_replace("division", $carving->division, $link);
    $link = str_replace("category", $carving->category, $link);
    ?>


    <div class="card container" style="padding: 0">
        <div class="card-header">Edit Carving</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="/carving/{{ $carving->id }}/update" method="POST" enctype="multipart/form-data">
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
                      name="description" autofocus required
                      placeholder="Description of carving and type of wood or other media"
                      rows="6">{{ $carving->description }}</textarea>

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

                <div class="form-group row">
                    <label for="photos" class="col-md-4 col-form-label text-md-right">{{ __('Photos') }}</label>

                    <?php $isValid = $errors->has('photos') ? ' is-invalid' : ''; ?>
                    <div class="col-md-6">
                        {!! Form::file('photos[]', ['multiple' => true, "accept" => "image/*", 'id' => 'photos', 'class' => "form-control $isValid col-11" ]) !!}
                        <span style="font-style: italic; font-size: 13px">Upload photos from the same location</span>
                        <div id="spinner" style="display: none"><img src="https://cdn.lowgif.com/full/ee5eaba393614b5e-pehliseedhi-suitable-candidate-suitable-job.gif" alt="Loading..." style="width: 50px; height: 50px"></div>
                        @if ($errors->has('photos'))
                            <span class="invalid-feedback"><strong>{{ $errors->first('photos') }}</strong></span>
                        @endif
                    </div>

                    <label for="photos" class="col-md-4 col-form-label text-md-right"></label>
                    <div class="col-md-6 photo-preview">

                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right"></label>
                    <div>
                        @foreach($photos as $photo)
                            <div style="height: 90px; width:90px;position:relative; display: inline-block;float: left; margin-left: 5px;">
                                <a href="#">
                                    <div style="position: absolute; height:25px; width:25px; right: 0; top: 0; z-index: 99; background-color: white; text-align: center"
                                         class="deletePhoto" storage-id="{!! $photo->id !!}">
                                        X
                                    </div>
                                </a>
                                <a href="/storage/{!! $photo->filename !!}" target="_blank">
                                    <img style="height: 100%; width: 100%;z-index: 10;position: absolute"
                                         src="/storage/{!! $photo->filename !!}"></a>
                            </div>
                        @endforeach
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
      function onChangeDivision () {
        var division = $('#division').val()

        $('#category').children().hide()
        $('#category option[division="' + division + '"]').show()
        $('#category').val($('#category option[division="' + division + '"]').first().val())

      }

      $(function () {
        onChangeDivision()
        $("select#category option[value={{$carving->category}}]").prop('selected', true)
      })

      $(function () {
        $('#upload-images').on('click', function (e) {
          e.preventDefault()

          window.open("{!! $link !!}", $(this).attr('target'))
        })

        $('.deletePhoto').click(function () {
          $.ajax({
            url: '/storage/delete/' + $(this).attr('storage-id'),
            method: 'post',
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          }).then(function () {
            location.reload()
          }).catch(function () {
            alert('Oops something went wrong!')
          })
        })

        function loadImgWithPhoto (file) {
          if (!file) {
            return
          }

          var reader = new FileReader()

          reader.onload = function (e) {
            $previewImage = $('<img class="preview" style="width: 100px; height: 100px;margin:3px">').attr('src', e.target.result)
            $('.photo-preview').append($previewImage)
          }

          // convert to base64 string
          reader.readAsDataURL(file)
        }

        $('#photos').change(function () {
          const input = this

          if (input.files) {
            $('.photo-preview').html('')
            for (var i = 0; i < input.files.length; i++) {
              loadImgWithPhoto(input.files[i])
            }
          }
        })

        $('#photos').on('change', function () {
          $('#spinner').css('display', 'none');
        })

        $('#photos').on('input', function () {
          $('#spinner').css('display', 'block');
        })
      })
    </script>
@endsection