@if(auth()->guard('admin'))
    <a href="{{url('admin/')}}" class="btn btn-success btn-lg"><i class="fa fa-home mr-1"></i> BACK HOME</a>
@elseif(auth()->guard('employee'))
    <a href="{{url('employee/')}}" class="btn btn-success btn-lg"><i class="fa fa-home mr-1"></i> BACK HOME</a>
@endif
