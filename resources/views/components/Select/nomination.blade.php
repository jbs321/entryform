{!!
    Form::select('nomination', \App\Http\Controllers\CarvingController::NOMINATIONS, $carving->nomination,  [
       "id"            => "nomination",
       "required"      => "required",
       "autofocus"     => "autofocus",
       "class"         => "form-control"
   ])
!!}