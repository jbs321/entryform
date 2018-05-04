<?php
    $carvings = \Illuminate\Support\Facades\Auth::user()->carvings->toArray();
?>

<div class="card" style="margin-bottom: 30px;">
    <div class="card-header">{{ __('Registered Carvings') }} <span style="font-weight: bold;float: right;">Total Price: {!! \App\Http\Controllers\HomeController::calcPrice(count($carvings)) !!}$ CAD</span></div>
    <div class="card-body" style="overflow-y: scroll;height: 300px;padding: 0;">
        <table class="table table-striped" style="margin: 0">
            <thead>
            <tr>
                <th scope="col">Tag Number</th>
                <th scope="col">Skill Level</th>
                <th scope="col">Division</th>
                <th scope="col">Category</th>
                <th scope="col">Description</th>
                <th scope="col">For Sale?</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>

            <tbody>
                @foreach($carvings as $carving)
                    <tr>
                        <th scope="row">{!! $carving['id'] !!}</th>
                        <td>{!! $carving['skill'] !!}</td>
                        <td>{!! $carving['division'] !!}</td>
                        <td>{!! $carving['category']!!}</td>
                        <td>{!! $carving['description'] !!}</td>
                        <td>{!! $carving['is_for_sale'] !!}</td>
                        <td>
                            <button type="button" class="btn btn-info" onclick="window.location = '{{'/carving/'.$carving['id'].'/edit'}}'" style="float: left">Edit</button>
                            <form action="/carving/{!! $carving['id'] !!}/delete" method="POST" style="float: left">
                                {{csrf_field()}}
                                <input type="hidden" value="{{$carving['id']}}" name="id" id="id">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer">
        <button type="button" class="btn btn-info" onclick="addCarving()">
            Register New Carving
        </button>

        <?php if(count($carvings) > 0): ?>
        <a href="/carving/excel/{{\Illuminate\Support\Facades\Auth::user()->id}}">Download Excel</a>
        <?php endif; ?>
    </div>
</div>

<script>
    function addCarving() {
        $('.add-carving').css('display','block');
    }
</script>