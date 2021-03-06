@extends('layouts.templates.event')
@section('title','New Gender Series Participants')
@section('content')

    <div class="row justify-content-center">
      <div class="col-md-10">
         <div class="card">
            <div class="card-header">
               <div class="float-left">
                  <h4 class="header-title">New GDSS Participants</h4>
               </div>
               <div class="float-right">
                  <a class="btn btn-warning text-white" href="{{route('genderSeriesParticipants.index')}}" title="create"><i class="fa fa-list"></i> view GDSS Participants</a>
               </div>
            </div>
            <div class="card-body">
               @include('alerts._flash')
               <form method="POST" action="{{route('genderSeriesParticipants.store')}}" class="form" autocomplete="off">
                   @include('participants.genderSeries._form',['buttonText'=>'Save'])
               </form>
            </div>
         </div>
      </div>
   </div>

@endsection
