@extends('layouts.templates.event')
@section('title','GDSS Participants')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h4 class="header-title">New GDSS Participants</h4>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-warning text-white" href="{{route('genderSeries.index')}}" title="create"><i class="fa fa-list mr-1"></i> GDSS Topics</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    <form method="POST" action="{{route('genderSeriesParticipants.store')}}" class="form" autocomplete="off">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-8">
                                <label class="col-form-label">GDSS Topic Name <span class="star">*</span></label>
                                <input type="text" value="{{$genderSeries->topic}}" class="form-control" readonly/>
                                <input name="gender_series_id" type="hidden" value="{{$genderSeries->id}}" class="form-control" />
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label">Date<span class="star">*</span></label>
                                <input type="text" value="{{mysql_to_date($genderSeries->date)}}" class="form-control" readonly/>
                                <input name="date" type="hidden" value="{{$genderSeries->date}}" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                @include('partials.individuals.singleDropdown',['old'=>null,'label'=>'Participant Name'])
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                @include('partials.organizations.singleDropdown',['old'=> null])
                            </div>
                            <div class="col-md-6">
                                @include('partials.wards.dropdown',['old'=>null])
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            <div class="col-md-12">
                                <div class="float-left">
                                    <a class="btn btn-dark" href="{{route('genderSeries.index')}}" title="create">cancel</a>
                                </div>
                                <div class="float-right">
                                    <input type="submit" class="btn btn-success" value="Save"/>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
