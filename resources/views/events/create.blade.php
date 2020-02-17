@extends('layouts.admin')
@section('title','New event')
@section('content')

    <div class="row justify-content-center">
      <div class="col-md-6">
         <div class="card">
            <div class="card-header">
               <div class="float-left">
                  <h4 class="header-title">New Event</h4>
               </div>
               <div class="float-right">
                  <a class="btn btn-primary" href="{{route('events.index')}}" title="create"><i class="fa fa-list mr-1"></i> view events</a>
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
