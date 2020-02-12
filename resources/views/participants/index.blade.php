@extends('layouts.event')
@section('title','Event Participants')
@section('content')

    <div class="card event">
        <div class="card-header">
            <div class="float-left">
                <h1 class="h4">Event Participants</h1>
            </div>
            <div class="float-right">
                @can('participant-export')
                    <a class="btn btn-outline-secondary mr-3" href="{{route('participants.export')}}" title="Export"><i class="fa fa-download"></i> Export</a>
                @endcan
                @can('participant-create')
                    <a class="btn btn-primary" href="{{route('participants.create')}}" title="create"><i class="fa fa-plus"></i> Event Participants</a>
                @endcan
            </div>
        </div>
        <div class="card-body">
            @include('alerts._flash')

            <div class="table-responsive">
                @include('participants.components.index')
            </div>
        </div>
    </div>

@endsection