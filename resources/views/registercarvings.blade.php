<?php
$carvings = \Illuminate\Support\Facades\Auth::user()->carvings->toArray();
$price = (count($carvings)) * 6;
?>

<div class="card add-carving">
    <div class="card-header">Add Carving</div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('carving') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group row">
                <label for="skill" class="col-md-4 col-form-label text-md-right">{{ __('Skill Level') }}</label>
                <?php $isValid = $errors->has('skill') ? ' is-invalid' : ''; ?>
                <div class="col-md-6">
                    {!! Form::select('skill', [
                           ""             => "",
                           "Student"      => "Student",
                           "Novice"       => "Novice",
                           "Intermediate" => "Intermediate",
                           "Advanced"     => "Advanced",
                           "Expert"       => "Expert",
                    ], "",  [
                        "id"            => "skill",
                        "required"      => "required",
                        "autofocus"     => "autofocus",
                        "class"         => "form-control $isValid",
                    ])!!}
                    @if ($errors->has('skill'))
                        <span class="invalid-feedback"><strong>{{ $errors->first('skill') }}</strong></span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="division" class="col-md-4 col-form-label text-md-right">{{ __('Division') }}</label>
                <?php $isValid = $errors->has('division') ? ' is-invalid' : ''; ?>
                <div class="col-md-6">
                    {!! Form::select('division', \App\Http\Controllers\CarvingController::DIVISIONS, null,  [
                        "id"            => "division",
                        "required"      => "required",
                        "autofocus"     => "autofocus",
                        "onchange"      => "onChangeDivision(this)",
                        "class"         => "form-control $isValid",
                    ])!!}
                    @if ($errors->has('division'))
                        <span class="invalid-feedback"><strong>{{ $errors->first('division') }}</strong></span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>

                <div class="col-md-6">

                    <?php $isValid = $errors->has('category') ? ' is-invalid' : ''; ?>

                    <select name="category"
                            id="category"
                            required
                            autofocus
                            style="padding: 0;"
                            class="form-control {!! $isValid !!}">

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
                      name="description" required autofocus
                      placeholder="Description of carving and type of wood or other media"
                      rows="6">{{ old('description') }}</textarea>

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
                    ], null,  [
                        "id"            => "is_for_sale",
                        "required"      => "required",
                        "autofocus"     => "autofocus",
                        "value"         => old('is_for_sale'),
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
                    {!! Form::file('photos[]', ['multiple' => true, "accept" => "image/*", 'id' => 'photos', 'class' => "form-control $isValid" ]) !!}
                    @if ($errors->has('photos'))
                        <span class="invalid-feedback"><strong>{{ $errors->first('photos') }}</strong></span>
                    @endif
                </div>
                <label for="photos" class="col-md-4 col-form-label text-md-right"></label>
                <div class="col-md-6 photo-preview">

                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary" id="submit-carving">
                        {{ __('Submit Carving') }}
                    </button>
                </div>
            </div>
        </form>

    </div>

    <div class="card-footer" id="carving-price" style="font-weight: bold">Price: $6 CAD</div>
</div>
<script>
  function onChangeDivision () {
    var division = $('#division').val()

    $('#category').children().each(function () {
      $(this).addClass('hidden')
      $(this).attr('disabled', 'true')
    })

    $('#category option[division="' + division + '"]').each(function () {
      $(this).removeClass('hidden')
      $(this).removeAttr('disabled')
    })
    $('#category').val($('#category option[division="' + division + '"]').first().val())

  }

  function debounce (func, wait, immediate) {
    var timeout
    return function () {
      var context = this, args = arguments
      var later = function () {
        timeout = null
        if (!immediate) func.apply(context, args)
      }
      var callNow = immediate && !timeout
      clearTimeout(timeout)
      timeout = setTimeout(later, wait)
      if (callNow) func.apply(context, args)
    }
  }

  $(function () {
    onChangeDivision()
      <?php
          if(isset($isSubmitted)):
          ?>
      if ('{{$isSubmitted}}' == 1) {
        alert('You have successfully registered a Carving for the show, You can now Logoff or continue adding more Carvings')
      }
      <?php
      endif;
      ?>

      $('#skill').on('change', function () {
        if ($(this).val() == 'Student') {
          $('#carving-price').html('Price: $0 CAD')
        } else {
          $('#carving-price').html('Price: $6 CAD')
        }
      })

    $('#division').on('change', function () {
      if ($(this).val() == 'R: Courtesy Carvings') {
        $('#carving-price').html('Price: $0 CAD')
      } else {
        $('#carving-price').html('Price: $6 CAD')
      }
    })

    function loadImgWithPhoto (file) {
      if (!file) {
        return
      }

      var reader = new FileReader()

      reader.onload = function (e) {
        $previewImage = $('<img class="preview" style="width: 100px; height: 100px;margin:3px">').attr('src', e.target.result);
        $(".photo-preview").append($previewImage);
      }

      // convert to base64 string
      reader.readAsDataURL(file)
    }

    $('#photos').change(function () {
      const input = this

      if (input.files) {
        $(".photo-preview").html("");
        for(var i = 0; i < input.files.length; i++) {
          loadImgWithPhoto(input.files[i]);
        }
      }
    })
  })

  @if (count($errors) > 0)
  addCarving()
    @endif

</script>
