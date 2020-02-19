@extends('layouts.admin')
@section('title','New Gender Series Topic')
@section('content')

    <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header">
               <div class="float-left">
                  <h4 class="header-title">New Gender Series Topic</h4>
               </div>
               <div class="float-right">
                  <a class="btn btn-primary" href="{{route('genderSeries.index')}}" title="create"><i class="fa fa-list mr-1"></i> Go to List</a>
               </div>
            </div>
            <div class="card-body">
               @include('alerts._flash')
               <form method="POST" action="{{route('genderSeries.store')}}" class="form" autocomplete="off">
                   @include('events.genderSeries._form',['buttonText'=>'Save'])
               </form>
            </div>
         </div>
      </div>
   </div>

@endsection
