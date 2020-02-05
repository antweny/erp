@extends('layouts.master')

@section('body')


    <div class="row">
        <div class="col-md-2">
            <div class="inside-menu card">
                <div class="card-body">
                    <ul class="list-group list-group-flush p-0">

                        @can('country-read')
                            <a class="list-group-item" href="{{route('countries.index')}}">
                                <i class="fa fa-flag"></i>
                                Countries
                            </a>
                        @endcan

                        @can('city-read')
                            <a class="list-group-item" href="{{route('cities.index')}}">
                                <i class="fa fa-flag"></i>
                                Cities/Regions
                            </a>
                        @endcan

                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-10">
            @yield('content')
        </div>
    </div>

@endsection
