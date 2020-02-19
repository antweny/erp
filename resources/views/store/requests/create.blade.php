@extends('layouts.admin')
@section('title','Request Item')
@section('content')


    <div class="row justify-content-center">
      <div class="col-md-6">
         <div class="card">
            <div class="card-header">
               <div class="float-left">
                  <h4 class="header-title">Request Item</h4>
               </div>
               <div class="float-right">
                  <a class="btn btn-primary" href="{{route('itemRequests.index')}}" title="create"><i class="fa fa-list mr-1"></i>items requests</a>
               </div>
            </div>
            <div class="card-body">
               @include('alerts._flash')
               <form method="POST" action="{{route('itemRequests.store')}}" class="form" autocomplete="off">
                   @include('store.requests._form',['buttonText'=>'Save Record'])
               </form>
            </div>
         </div>
      </div>
   </div>


@endsection