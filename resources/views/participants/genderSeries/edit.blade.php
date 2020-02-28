@extends('layouts.templates.event')
@section('title','Update GDSS Participants')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h1 class="h4">Update GDSS Participants</h1>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-warning text-white" href="{{route('genderSeriesParticipants.index')}}" title="create"><i class="fa fa-list"></i>view GDSS participants</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    <form method="POST" action="{{route('genderSeriesParticipants.update',$genderSeriesParticipant->id)}}" class="form" autocomplete="off">
                        @method('PUT')
                        @include('participants.genderSeries._form',['buttonText'=>'Update'])
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

