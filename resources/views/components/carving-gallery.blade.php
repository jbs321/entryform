<div class="container page-top">
    <div class="row">
        <hr class="my-5"/>
        <div class="gallery"></div>
        @foreach($carvings as $carving)
            @foreach($carving->photos as $photo)
                <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                    <a href="https://bonathea.sirv.com/Images/{{ $photo->filename }}" data-fancybox="carving"
                       rel="ligthbox" data-caption="{{"Skill: $carving->skill, Division: $carving->division, Category: $carving->category, Description: $carving->description"}}">
                        <img src="https://bonathea.sirv.com/Images/{{ $photo->filename }}" class="zoom img-fluid"
                             alt="{{$carving->description}}">
                    </a>
                </div>
            @endforeach
        @endforeach
    </div>

    @if($carvings->isEmpty())
        <div style="text-align: center;font-size: 25px;">No Carvings Found</div>
    @endif

    <div class="row paginator-row">
        {{ $carvings->links() }}
    </div>
</div>

<div class="loader">
    <div class="loader-inner loading">
        <div class="loading-box">
            <div class="circular-loader">
            </div>
            <div class="loader-message">Loading...</div>
        </div>
    </div>
</div>