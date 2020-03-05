@extends('layouts.error')
@section('title','400! Bad Request')
@section('content')

    <h1>400!</h1>
    <h5 class="text-primary">Bad Request</h5>
    <p class="tx-16 mg-b-30">
        The server did not understand the request.
    </p>

    @include('errors.return')



@endsection
