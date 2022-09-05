<div class="card" style="margin-bottom: 30px;">
    <div class="card-header">Admin Dashboard</div>
    <div class="card-body" style="padding: 0;">
        <div style="overflow-y: scroll;max-height: 600px">
            <table class="table table-striped" style="margin: 0">
                <thead>
                <tr>
                    <th scope="col">Control</th>
                    <th scope="col">Value</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td scope="row">Registration</td>
                    <td scope="row">{{env('ENTRYFORM_REGISTRATION', 1) ? "On" : "Off"}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>