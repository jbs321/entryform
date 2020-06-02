@extends('layouts.app')

@section('content')

    <div class="container page-top">
        <form action="/gallery" method="get">
            <div class="row form-group">
                <div class="col-md-10 offset-1">
                    <div class="row">
                        <div class="col-xs-12 col-md-3 margin-top-10">
                            @component('components.Select.skill')
                            @endcomponent
                        </div>
                        <div class="col-xs-12 col-md-3 margin-top-10">
                            @component('components.Select.division', compact('divisions'))
                            @endcomponent
                        </div>
                        <div class="col-xs-12 col-md-3 margin-top-10">
                            @component('components.Select.category', compact('divisionsCategories'))
                            @endcomponent
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12  col-md-3 margin-top-10">
                            @component('components.Select.award-select', compact('awards'))
                            @endcomponent
                        </div>

                        <div class="col-xs-12 col-md-3 margin-top-10">
                            @component('components.Select.type', compact('types'))
                            @endcomponent
                        </div>

                        @if(Auth::check())
                            <div class="col-xs-12 col-md-3 margin-top-10" style="padding-top: 8px;">
                                {{Form::checkbox("my_carving", old('my_carving'), false)}} Show Only My Carvings
                            </div>
                        @endif

                        <div class="col-xs-6 margin-top-10 @if(!Auth::check()) offset-md-3 @endif col-md-1">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="container padding-10">
        @component('components.carving-paginator', compact('carvings')) @endcomponent

        @component('components.carving-gallery', compact('carvings')) @endcomponent

        @component('components.carving-paginator', compact('carvings')) @endcomponent
    </div>



    <script>
      function onChangeDivisionLocal () {
        onChangeDivision('#division', '#category')
      }

      $(function () {
        $('.zoom').hover(function () {
          $(this).addClass('transition')
        }, function () {
          $(this).removeClass('transition')
        })

        $('.ribbon').hover(function () {
          $(this).addClass('transition-cool')
        }, function () {
          $(this).removeClass('transition-cool')
        })

        var fb_default = window.fancybox.defaults

          @if(isset($user) && $user->user_role != \App\User::ROLE_JUDGE)
          if (fb_default.btnTpl.nominate !== undefined) {
            delete fb_default.btnTpl.nominate
          }
          @endif

          $('[data-fancybox="carving"]').fancybox(fb_default)

      })
    </script>
@endsection
