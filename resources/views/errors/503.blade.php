@extends('layouts.error')
@section('title','503! Service Unavailable')
@section('content')


    <h1>503!</h1>
    <h5 class="text-primary">Service Unavailable</h5>
    <p class="tx-16 mg-b-30">
        The request was not completed. The server is temporarily overloading or down.
    </p>

    @include('errors.return')


@endsection
