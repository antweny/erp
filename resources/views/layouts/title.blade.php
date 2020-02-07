@extends('layouts.master')

@section('body')

    <div class="row">
        <div class="col-md-2">
            <div class="inside-menu card">
                <div class="card-body">
                    <ul class="list-group list-group-flush p-0">
                        @can('title-read')
                            <a class="list-group-item" href="{{route('titles.index')}}">
                                <i class="fa fa-heading"></i>
                                Titles
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
