<select name="category" id="category" autofocus class="form-control">
    {{-- Default --}}
    <option value="" selected class="all">All Categories</option>

    @foreach($divisionsCategories as $division => $categories)
        @foreach($categories as $id => $category)
            @if($id == old('category'))
                <option value="{!! $id !!}" division="{{$division}}" title="{{$division}}" class="category" selected>
                    {!! "$id - $category" !!}
                </option>
            @else
                <option value="{!! $id !!}" division="{{$division}}" title="{{$division}}" class="category">
                    {!! "$id - $category" !!}
                </option>
            @endif
        @endforeach
    @endforeach
</select>