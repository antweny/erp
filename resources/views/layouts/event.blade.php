@extends('layouts.master')

@section('body')

    <div class="row">
        <div class="col-md-2">
            <div class="inside-menu card">
                <div class="card-body">
                    <ul class="list-group list-group-flush p-0">

                        @can('eventCategory-read')
                            <a class="list-group-item" href="{{route('eventCategories.index')}}">
                                <i class="fa fa-list-alt"></i>
                                Event Categories
                            </a>
                        @endcan

                        @can('event-read')
                            <a class="list-group-item" href="{{route('events.index')}}">
                                <i class="fa fa-calendar"></i>
                                Events
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

