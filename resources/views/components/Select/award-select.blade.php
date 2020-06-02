<select name="award" id="award" autofocus class="form-control">
    {{-- Default --}}
    <option value="" selected class="all">All Awards</option>

    @foreach($awards as $award)
        @if($award == old('award'))
            <option selected value="{{$award}}">{{$award}}</option>
        @else
            <option value="{{$award}}">{{$award}}</option>
        @endif

    @endforeach
</select>