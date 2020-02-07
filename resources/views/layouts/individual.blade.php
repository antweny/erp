@extends('layouts.master')

@section('body')

    <div class="row">
        <div class="col-md-2">
            <div class="inside-menu card">
                <div class="card-body">
                    <ul class="list-group list-group-flush p-0">

                        @can('educationLevel-read')
                            <a class="list-group-item" href="{{route('educationLevels.index')}}">
                                <i class="fa fa-signal"></i>
                                Education Level
                            </a>
                        @endcan

                        @can('individual-read')
                            <a class="list-group-item" href="{{route('individuals.index')}}">
                                <i class="fa fa-users"></i>
                                Individual
                            </a>
                        @endcan

                        @can('title-read')
                            <a class="list-group-item" href="{{route('titles.index')}}">
                                <i class="fa fa-heading"></i>
                                Position Titles
                            </a>
                        @endcan

                        @can('position-read')
                            <a class="list-group-item" href="{{route('positions.index')}}">
                                <i class="fa fa-briefcase"></i>
                                Positions
                            </a>
                        @endcan

                        @can('group-read')
                            <a class="list-group-item" href="{{route('groups.index')}}">
                                <i class="fa fa-user-tag"></i>
                                Groups
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

