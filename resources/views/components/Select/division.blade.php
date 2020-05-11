<select name="division" id="division" class="division form-control" onchange="onChangeDivisionLocal()" autofocus>
    <option value="" selected>All Divisions</option>

    @foreach($divisions as $division)
        @if(!empty($division))
            <option value="{{$division}}"
                    @if (old("division") == $division) selected @endif
            >{{$division}}</option>
        @endif
    @endforeach
</select>