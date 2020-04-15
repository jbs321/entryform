@component('mail::message')
    # New Carving Registered

    @component('mail::table')
        | Full Name 	| Email 	| Division 	| Category 	| Description 	| For Sale? 	|
        |-----------	|-------	|----------	|----------	|-------------	|-----------	|
        |{{$user->fname . " " . $user->lname}}|  {{$user->email}} | {{$carving->division}}         	| {{$carving->category}}         	|       {{$carving->description}}      	|      {{$carving->is_for_sale}}     	|
    @endcomponent
@endcomponent


