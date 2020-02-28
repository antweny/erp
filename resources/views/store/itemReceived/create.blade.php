@extends('layouts.templates.store')
@section('title','Receive Item')
@section('content')

    <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header">
               <div class="float-left">
                  <h5>Receive Item</h5>
               </div>
               <div class="float-right">
                  <a class="btn btn-warning text-white" href="{{route('itemReceived.index')}}" title="create"><i class="fa fa-list mr-1"></i>view received items</a>
               </div>
            </div>
            <div class="card-body">
               @include('alerts._flash')
               <form method="POST" action="{{route('itemReceived.store')}}" class="form" autocomplete="off">
                   @include('store.itemReceived._form',['buttonText'=>'Save Record'])
               </form>
            </div>
         </div>
      </div>
   </div>

@endsection
