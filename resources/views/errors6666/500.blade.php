@extends('layouts.error')
@section('title','500 Server Error')
@section('content')


    <h1>500</h1>
    <h5 class="text-primary">Internal Server Error</h5>
    <p class="tx-16 mg-b-30">
        We encountered an error and cannot fulfill the request. The error has been traced and
        we will work hard to get a fix out as soon as possible.
    </p>

    @include('errors.return')


@endsection
