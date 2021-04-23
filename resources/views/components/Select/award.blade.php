<div class="form-group row">
    @foreach($awards as $idx => $award)
        @if($idx == 12)
            <div class="col-md-3"></div>
        @endif
        <div class="col-md-3">
            <div class="checkbox">
                <img src="{{env('SIRV_PATH')}}ribbon/{{$award}}.gif" class="ribbon" style="height: 100px;z-index: 100;position: relative">
                <label>{{Form::checkbox($award, $award, in_array($award, $selected))}} {{$award}}</label>
            </div>
        </div>
    @endforeach
</div>

<script>
    $(() => {
      $('.ribbon').hover(function () {
        $(this).addClass('transition-cool')
      }, function () {
        $(this).removeClass('transition-cool')
      })
    })
</script>