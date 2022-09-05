<div class="card" style="margin-bottom: 30px;">
    <div class="card-header">
        Carvings - <a target="_blank" href="/carving/print/all">
            Download Excel
        </a></div>
    <div class="card-body" style="padding: 0;">
        <div style="overflow-y: scroll;max-height: 600px">
            <table class="table table-striped" id="admin-dashboard-table" style="margin: 0">
                <thead>
                <tr>
                    <th scope="col">Full Name</th>
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
                        <td scope="row">{!! $carving->user['fname'] !!} {!! $carving->user['lname'] !!}</td>
                        <td>{!! $carving->skill !!}</td>
                        <td>{!! $carving->division !!}</td>
                        <td>{!! $carving->category ." - ".$categories[$carving->division][$carving->category] !!}</td>
                        <td>{!! $carving->description !!}</td>
                        <td>{!! $carving->is_for_sale ? "Yes" : "No" !!}</td>
                        <td>
                            <button type="button" class="btn btn-info"
                                    onclick="window.location = '{{'/admin/carving/'. $carving->id .'/edit'}}'"
                                    style="float: left">Edit
                            </button>
                            <form action="{{'/admin/carving/'. $carving->id .'/delete'}}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger" style="float: left">
                                    Delete
                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>