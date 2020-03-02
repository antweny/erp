@extends('layouts.templates.individuals')
@section('title','New position')
@section('content')

    <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header">
               <div class="float-left">
                  <h4 class="header-title">New Position</h4>
               </div>
               <div class="float-right">
                  <a class="btn btn-warning text-white" href="{{route('positions.index')}}" title="create"><i class="fa fa-list mr-1"></i> view positions</a>
               </div>
            </div>
            <div class="card-body">
               @include('alerts._flash')
               <form method="POST" action="{{route('positions.store')}}" class="form" autocomplete="off">
                   @include('individuals.positions._form',['buttonText'=>'Save'])
               </form>
            </div>
         </div>
      </div>
   </div>

@endsection
