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


    @component('components.carving-gallery', compact('carvings'))
    @endcomponent


    <script>
      function onChangeDivisionLocal () {
        onChangeDivision('#division', '#category')
      }

      $(function () {
        onChangeDivision('#division', '#category')

        $('.zoom').hover(function () {
          $(this).addClass('transition')
        }, function () {
          $(this).removeClass('transition')
        })

        $('[data-fancybox="carving"]').fancybox(window.fancybox.defaults)
      })

      $(window).on('load', function () {
        $('.loader').hide()
      })
    </script>
@endsection
