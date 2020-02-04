@extends('layouts.store')
@section('title','Receive Item')
@section('content')

    <div class="row justify-content-center">
      <div class="col-md-4">
         <div class="card">
            <div class="card-header">
               <div class="float-left">
                  <h4 class="header-title">Receive Item</h4>
               </div>
               <div class="float-right">
                  <a class="btn btn-primary" href="{{route('itemReceived.index')}}" title="create"><i class="fa fa-list mr-1"></i>items received</a>
               </div>
            </div>
            <div class="card-body">
               @include('alerts._flash')
               <form method="POST" action="{{route('itemReceived.store')}}" class="form" autocomplete="off">
                   @include('items.received._form',['buttonText'=>'Save Record'])
               </form>
            </div>
         </div>
      </div>
   </div>

@endsection
