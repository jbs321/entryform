<div class="container page-top">

    <div class="row">
        <div class="gallery"></div>
        @foreach($carvings as $carving)
            @foreach($carving->photos as $idx => $photo)
                <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                    <a href="{{env('SIRV_PATH')}}{{ $photo->filename }}"
                       data-fancybox="carving"
                       data-title="{{$carving->description}}"
                       data-tag="{{$carving->id}}"
                       data-caption='<div><b>Tag No.</b>: {{$carving->id}}</div><div><b>From</b>: {{implode(", ", array_filter([$carving->user->country, $carving->user->city]))}}</div><div><b>Skill</b>: {{$carving->skill}}</div><div><b>Divison</b>: {{$carving->division}}</div><div><b>Category</b>: {{$carving->category}}</div><div class="carving-description">{{$carving->description}}</div><div class="ribbon-show-wrapper">{{$carving->awardsShow}}</div>'
{{--                       data-caption='<div><b>Tag No.</b>: {{$carving->id}}</div><div><b>Artist</b>: {{$carving->user->fname . " " . $carving->user->lname}}</div><div><b>From</b>: {{implode(", ", array_filter([$carving->user->country, $carving->user->city]))}}</div><div><b>Skill</b>: {{$carving->skill}}</div><div><b>Divison</b>: {{$carving->division}}</div><div><b>Category</b>: {{$carving->category}}</div><div class="carving-description">{{$carving->description}}</div><div class="ribbon-show-wrapper">{{$carving->awardsShow}}</div>'--}}
                       rel="ligthbox">
                        <div class="skeleton-loader">
                            <div class="avatar"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                        </div>

                        <img class="zoom img-fluid carving"
                             onerror="this.style.display='none'"
                             src=""
                             data-src="{{env('SIRV_PATH')}}{{ $photo->filename }}"
                             data-errsrc="/storage/{{ $photo->filename }}"
                             alt="{{$carving->description}}">

                            @foreach($carving->awards as $idx => $award)
                                <img class="ribbon" style="
                                        position: absolute;
                                        height: 77%;
                                        z-index: {{$idx}};
                                        left: {{(-25 + $idx * 35)  . "px"}};
                                        top: -18px;" src="{{env('SIRV_PATH')}}ribbons/{{$award->value}}.gif" alt="">
                            @endforeach
                    </a>
                </div>
            @endforeach
        @endforeach
    </div>

    @if($carvings->isEmpty())
        <div style="text-align: center;font-size: 25px;">No Carvings Found</div>
    @endif
</div>

<script>
  $(function () {
    $('.carving[data-src]').each((idx, img) => {
      var newImg = new Image

      newImg.onload = function () {
        img.src = this.src
        $(img).css('display', 'block')
        $(img).parent().find('.skeleton-loader').css('display', 'none')
      }

      newImg.onerror = function () {
        newImg.src = img.dataset.errsrc
      }

      newImg.src = img.dataset.src
    })
  })
</script>