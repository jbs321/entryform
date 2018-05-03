<?php
$carvings = $carvings->toArray();

if(count($carvings) > 0):
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
                <th scope="col">delete?</th>
            </tr>
            </thead>

            <tbody>
                @foreach($carvings as $carving)
                    <tr>
                        <th scope="row">{!! $carving['id'] !!}</th>
                        <td>{!! $carving['skill'] !!}</td>
                        <td>{!! $carving['division'] !!}</td>
                        <td>{!! $carving['category'] !!}</td>
                        <td>{!! $carving['description'] !!}</td>
                        <td>{!! $carving['is_for_sale'] !!}</td>
                        <td>
                            <button type="button" class="btn btn-danger" onclick="onDeleteCarving({{$carving['id']}})">Delete</button>
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
    </div>
</div>
<?php
endif;
?>

<script>
    function onDeleteCarving(carvingId) {
        window.location = '/carving/' + carvingId;
    }

    function addCarving() {
        $('.add-carving').css('display','block');
    }
</script>