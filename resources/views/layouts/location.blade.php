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
                                <i class="fa fa-city"></i>
                                Cities/Regions
                            </a>
                        @endcan

                        @can('district-read')
                            <a class="list-group-item" href="{{route('districts.index')}}">
                                <i class="fa fa-building"></i>
                                Districts
                            </a>
                        @endcan

                        @can('ward-read')
                            <a class="list-group-item" href="{{route('wards.index')}}">
                                <i class="fa fa-street-view"></i>
                                Wards
                            </a>
                        @endcan

                        @can('street-read')
                            <a class="list-group-item" href="{{route('streets.index')}}">
                                <i class="fa fa-road"></i>
                                Streets
                            </a>
                        @endcan

                        @can('venue-read')
                            <a class="list-group-item" href="{{route('venues.index')}}">
                                <i class="fa fa-compass"></i>
                                Venues
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
