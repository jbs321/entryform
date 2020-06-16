<select name="carver" id="carver" autofocus class="form-control">
    <option value="" selected class="all">All Carvers</option>

    @foreach($carvers as $carver)
        @if($carver->id == old('carver'))
            <option selected value="{{$carver->id}}">{{"$carver->fname $carver->lname"}}</option>
        @else
            <option value="{{$carver->id}}">{{"$carver->fname $carver->lname"}}</option>
        @endif
    @endforeach
</select>