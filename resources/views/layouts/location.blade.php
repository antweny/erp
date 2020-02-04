@extends('layouts.master')

@section('body')


    <div class="row">
        <div class="col-md-2">
            <div class="inside-menu card">
                <div class="card-body">
                    <ul class="list-group list-group-flush p-0">
                        @can('country-read')
                            <li class="list-group-item">
                                <a href="{{route('countries.index')}}">
                                    <i class="fa fa-flag"></i>
                                    Countries
                                </a>
                            </li>
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
