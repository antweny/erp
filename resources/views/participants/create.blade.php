@extends('layouts.event')
@section('title','Event  Participants')
@section('content')

    <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header">
               <div class="float-left">
                  <h4 class="header-title">New Participant</h4>
               </div>
               <div class="float-right">
                  <a class="btn btn-primary" href="{{route('participants.index')}}" title="create"><i class="fa fa-list mr-1"></i> Participants</a>
               </div>
            </div>
            <div class="card-body">
               @include('alerts._flash')
               <form method="POST" action="{{route('participants.store')}}" class="form" autocomplete="off">
                   @include('participants._form',['buttonText'=>'Save'])
               </form>
            </div>
         </div>
      </div>
   </div>

@endsection
