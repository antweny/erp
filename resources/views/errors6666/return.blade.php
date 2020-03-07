<a href="{{url()->previous()}}" class="btn btn-success mr-5"><i class="fa fa-backward mr-1"></i> GO BACK</a>
@if(auth()->guard('admin'))
    <a href="{{url('admin/')}}" class="btn btn-primary "><i class="fa fa-home mr-1"></i> BACK HOME</a>
@elseif(auth()->guard('employee'))
    <a href="{{url('employee/')}}" class="btn btn-success btn-lg"><i class="fa fa-home mr-1"></i> BACK HOME</a>
@endif
