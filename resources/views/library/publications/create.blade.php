@extends('layouts.templates.library')
@section('title','New Publication')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h4 class="header-title">New Publication</h4>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-warning text-white" href="{{route('publications.index')}}" title="create"><i class="fa fa-list"></i>View Publications</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    <form method="POST" action="{{route('publications.store')}}" class="form" autocomplete="off">
                        @include('library.publications._form',['buttonText'=>'Save'])
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
