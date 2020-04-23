<?php
$user = \Illuminate\Support\Facades\Auth::user();
$carvings = $user->carvings;

$countable = $carvings->filter(function (\App\Carving $carving ) {
    if(strtolower($carving->skill) == "student"
       ||$carving->division == \App\Http\Controllers\CarvingController::CATEGORY_R ) {
        return false;
    }

    return true;
});

$price = \App\Http\Controllers\HomeController::calcPrice($countable->count());

$carvings = $carvings->toArray();
?>

<div class="card" style="margin-bottom: 30px;">
    <div class="card-header">
        {{ __('Registered Carvings') }}
        <?php if(0 != $price): ?>
            <span style="font-weight: bold;float: right;">Payment Due: {!!$price !!} $ CAD <div id="paypal-button"></div></span>
        <?php endif; ?>

    </div>
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
                        <button type="button" class="btn btn-info" onclick="window.location = '{{'/carving/'.$carving['id'].'/edit'}}'"
                                style="float: left">Edit
                        </button>
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
        <button type="button" class="btn btn-info animated infinite pulse" onclick="addCarving()">
            Register New Carving
        </button>

        <?php if(count($carvings) > 0): ?>
        <a href="/carving/excel/{{\Illuminate\Support\Facades\Auth::user()->id}}">Download Excel</a>
        <?php endif; ?>
    </div>
</div>

<script>
    function addCarving() {
        $('.add-carving').css('display', 'block');
        $('html, body').animate({
            scrollTop: $(".add-carving").offset().top
        }, 1000);
    }

    $(function() {
      paypal.Button.render({
        // Configure environment
        env: 'sandbox',
        client: {
          sandbox: 'demo_sandbox_client_id',
          production: 'demo_production_client_id'
        },
        // Customize button (optional)
        locale: 'en_CA',
        style: {
          size: 'small',
          color: 'gold',
          shape: 'pill',
        },

        // Enable Pay Now checkout flow (optional)
        commit: true,

        // Set up a payment
        payment: function(data, actions) {
          return actions.payment.create({
            transactions: [{
              amount: {
                total: '{!! $price !!}',
                currency: 'CAD'
              }
            }]
          });
        },
        // Execute the payment
        onAuthorize: function(data, actions) {
          return actions.payment.execute().then(function() {
            $.ajax({
              url: "/user/" + "{!! $user->id !!}" + "/record-payment",
              method: "POST",
              data: {
                amount: "{!! $price !!}"
              },
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            }).then(function () {
                window.location.replace('/');
            });

            // Show a confirmation message to the buyer
            window.alert('Thank you for your purchase!');
          });
        }
      }, '#paypal-button');
    });
</script>