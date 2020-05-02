@extends('layouts.app')

@section('content')

    <div class="container page-top">
        <div class="row">
            <hr class="my-5" />
            <div class="gallery"></div>
            @foreach($carvings as $carving)
                @foreach($carving->photos as $photo)
                    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                        <a href="{{ $photo->link() }}" data-fancybox="carving" rel="ligthbox" data-caption="{{$carving->description}}">
                            <img src="{{ $photo->link() }}" class="zoom img-fluid" alt="{{$carving->description}}" style='background: url("https://66.media.tumblr.com/919795f053eee482e124e78671653838/tumblr_puozmqlhsd1xpfoefo1_250.gifv");background-size: 100% 100%; min-height: 200px; min-width: 100%'>
                        </a>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>

    <script>
      $(function () {
        $('.zoom').hover(function () {
          $(this).addClass('transition')
        }, function () {
          $(this).removeClass('transition')
        })

        $('[data-fancybox="carving"]').fancybox(window.fancybox.defaults)
      })
    </script>
@endsection
