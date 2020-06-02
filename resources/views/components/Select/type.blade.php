<select name="type" id="type" autofocus class="form-control">
    <option value="" selected class="all">All Types</option>

    @foreach($types as $key => $value)
        @if($key == old('type'))
            <option selected value="{{$key}}">{{$value}}</option>
        @else
            <option value="{{$key}}">{{$value}}</option>
        @endif
    @endforeach
</select>