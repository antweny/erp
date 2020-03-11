@extends('layouts.error')
@section('title','403 Forbidden')
@section('content')

    <h1>403</h1>
    <h5 class="text-primary">Forbidden</h5>
    <p class="tx-16 mg-b-30">
        You do not have permission to view this directory or page using the credentials that you supplied.
    </p>

    @include('errors.return')



@endsection
