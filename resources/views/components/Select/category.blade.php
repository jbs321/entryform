<select name="category"
        id="category"
        autofocus
        class="form-control">
    <option value="" selected>All Categories</option>

    @foreach($divisionsCategories as $division => $categories)
        @foreach($categories as $id => $category)
            <option value="{!! $id !!}" division="{{$division}}" title="{{$division}}"
            @if (old("category") == $category) selected @endif >
                {!! "$id - $category" !!}
            </option>

        @endforeach
    @endforeach
</select>