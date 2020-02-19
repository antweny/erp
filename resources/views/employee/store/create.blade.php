@extends('layouts.employee')
@section('title','Request Item')
@section('content')


    <div class="row justify-content-center">
      <div class="col-md-4">
         <div class="card">
            <div class="card-header">
               <div class="float-left">
                  <h4 class="header-title">Request Item</h4>
               </div>
               <div class="float-right">
                  <a class="btn btn-primary" href="{{route('employee.itemRequests.index')}}" title="create"><i class="fa fa-list mr-1"></i>items requests</a>
               </div>
            </div>
            <div class="card-body">
               @include('alerts._flash')
               <form method="POST" action="{{route('employee.itemRequests.store')}}" class="form" autocomplete="off">
                   @include('employee.store._form',['buttonText'=>'Save Record'])
               </form>
            </div>
         </div>
      </div>
   </div>


@endsection
