@extends('layouts.app')

@section('content')

    <div class="container page-top">
        <form action="/gallery" method="get">
            <div class="row form-group">
                <div class="col-md-10 offset-1">
                    <div class="row">
                        <div class="col-xs-12 col-md-3">
                            @component('components.Select.skill')
                            @endcomponent
                        </div>
                        <div class="col-xs-12 col-md-3">
                            @component('components.Select.division', compact('divisions'))
                            @endcomponent
                        </div>
                        <div class="col-xs-12 col-md-3">
                            @component('components.Select.category', compact('divisionsCategories'))
                            @endcomponent
                        </div>
                        <div class="col-xs-6 col-md-1">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="container">
        <div class="row paginator-row">
            {{ $carvings->appends(['skill' => $_GET['skill'] ?? null, 'division' => $_GET['division'] ?? null, 'category' => $_GET['category'] ?? null])->links() }}
        </div>
    </div>

    @component('components.carving-gallery', compact('carvings'))
    @endcomponent

    <div class="container">
        <div class="row paginator-row">
            {{ $carvings->appends(['skill' => $_GET['skill'] ?? null, 'division' => $_GET['division'] ?? null, 'category' => $_GET['category'] ?? null])->links() }}
        </div>
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

          @if($user->user_role != \App\User::ROLE_JUDGE)
          if (fb_default.btnTpl.nominate !== undefined) {
            delete fb_default.btnTpl.nominate
          }
          @endif

          $('[data-fancybox="carving"]').fancybox(fb_default)

      })
    </script>
@endsection
