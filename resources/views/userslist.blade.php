<div class="card" style="margin-bottom: 30px;">
    <div class="card-header">{{ __('Registered Users') }} <a href="/admin/user/downloadExcel">Download Excel</a></div>
    <div class="card-body" style="overflow-y: scroll;height: 300px;padding: 0;">
            <table class="table table-striped" style="margin: 0">
                <thead>
                <tr>
                    <th scope="col">Full Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">City</th>
                    <th scope="col">Province</th>
                    <th scope="col">Address</th>
                    <th scope="col">Postal Code</th>
                    <th scope="col">Created On</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>

                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{!! $user->fname . " ". $user->lname !!}</td>
                        <td>{!! $user->email !!}</td>
                        <td>{!! $user->phone_number !!}</td>
                        <td>{!! $user->city !!}</td>
                        <td>{!! $user->province !!}</td>
                        <td>{!! $user->address !!}</td>
                        <td>{!! $user->postal_code !!}</td>
                        <td>{!! $user->pst !!}</td>
                        <td>
                            <button type="button" class="btn btn-info"
                                    onclick="window.location = '{{'/user/'.$user['id'].'/edit'}}'" style="float: left">
                                Edit
                            </button>
                            <form action="/admin/user/{!! $user->id !!}/delete" method="POST" style="float: left">
                                @csrf
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
</div>
