@extends('layouts.error')
@section('title','401! Unauthorized')
@section('content')

    <h1>401!</h1>
    <h5 class="text-primary">Unauthorized</h5>
    <p class="tx-16 mg-b-30">
        You are not authorized to view this page due to invalid authentication credentials
    </p>

    @include('errors.return')



@endsection
