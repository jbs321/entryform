<div class="form-group row">
    @foreach($awards as $idx => $award)
        @if(in_array($idx, [7]))
            <div class="col-md-3"></div>
        @endif
        <div class="col-md-3">
            <div class="checkbox">
                <img src="{{env('SIRV_PATH')}}ribbons/{{$award}}.gif" class="ribbon" style="height: 100px;z-index: 100;position: relative">
                <label>
                    <input name={{$award}} value={{$award}} type="checkbox" <?= in_array($award, $selected) ? "checked='checked'" : "" ?>>
                    {{$award}}
                </label>
            </div>
        </div>
    @endforeach
</div>

<script>
    // $(() => {
    //   $('.ribbon').hover(function () {
    //     $(this).addClass('transition-cool')
    //   }, function () {
    //     $(this).removeClass('transition-cool')
    //   })
    // })
</script>