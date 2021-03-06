@extends('layouts.templates.event')
@section('title','New event')
@section('content')
    <div class="row justify-content-center">
      <div class="col-md-10">
         <div class="card">
            <div class="card-header">
               <div class="float-left">
                  <h4 class="header-title">New Event</h4>
               </div>
               <div class="float-right">
                  <a class="btn btn-warning text-white" href="{{route('events.index')}}" title="create"><i class="fa fa-list"></i> view events</a>
               </div>
            </div>
            <div class="card-body">
               @include('alerts._flash')
               <form method="POST" action="{{route('events.store')}}" class="form" autocomplete="off">
                   @include('events._form',['buttonText'=>'Save'])
               </form>
            </div>
         </div>
      </div>
   </div>

@endsection
