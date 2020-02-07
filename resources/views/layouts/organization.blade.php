@extends('layouts.master')

@section('body')


    <div class="row">
        <div class="col-md-2">
            <div class="inside-menu card">
                <div class="card-body">
                    <ul class="list-group list-group-flush p-0">
                        @can('organizationCategory-read')
                            <a class="list-group-item" href="{{route('categories.index')}}">
                                <i class="fa fa-flag"></i>
                                Categories
                            </a>
                        @endcan

                        @can('organization-read')
                            <a class="list-group-item" href="{{route('organizations.index')}}">
                                <i class="fa fa-city"></i>
                                Organisation
                            </a>
                        @endcan

                        @can('sector-read')
                            <a class="list-group-item" href="{{route('sectors.index')}}">
                                <i class="fa fa-industry"></i>
                                Sectors
                            </a>
                        @endcan

                        @can('field-read')
                            <a class="list-group-item" href="{{route('fields.index')}}">
                                <i class="fa fa-bars"></i>
                                Sector Fields
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
