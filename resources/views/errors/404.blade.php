@extends('layouts.error')
@section('title','404! Page Not Found')
@section('content')

    <h1>404!</h1>
    <h5 class="text-primary">Page not found.</h5>
    <p class="tx-16 mg-b-30">
        The page you are looking for might have been removed, had its name changed,
        or unavailable.
    </p>

    @include('errors.return')



@endsection
