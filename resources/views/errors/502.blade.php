@extends('layouts.error')
@section('title','502 Bad Gateway')
@section('content')


    <h1>502</h1>
    <h5 class="text-primary">Bad Gateway</h5>
    <p class="tx-16 mg-b-30">
        The request was not completed. The server received an invalid response from the upstream server.
    </p>

    @include('errors.return')


@endsection
