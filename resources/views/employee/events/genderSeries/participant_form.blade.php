@extends('layouts.admin')
@section('title','GDSS Participants')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h4 class="header-title">New GDSS Participants</h4>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary" href="{{route('genders.index')}}" title="create"><i class="fa fa-list mr-1"></i> GDSS Topics</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    <form method="POST" action="{{route('genderParticipants.store')}}" class="form" autocomplete="off">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-8">
                                <label class="col-form-label">GDSS Topic Name <span class="star">*</span></label>
                                <input type="text" value="{{$gender->topic}}" class="form-control" readonly/>
                                <input name="gender_series_id" type="hidden" value="{{$gender->id}}" class="form-control" />
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label">Date<span class="star">*</span></label>
                                <input type="text" value="{{mysql_to_date($gender->date)}}" class="form-control" readonly/>
                                <input name="date" type="hidden" value="{{$gender->date}}" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="col-form-label">Participant Name <span class="star">*</span></label>
                                <select name="individual_id" class="form-control single-select"  required>
                                    <option value="">Please select...</option>
                                    @foreach($individuals as $individual)
                                        <option value="{{$individual->id}}" {{old('individual_id') == $individual->id ? 'selected' : '' }}>{{$individual->full_name}}</option>
                                    @endforeach
                                </select>
                                @error('individual_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="col-form-label">Group/Organization Name</label>
                                <select name="organization_id" class="single-select form-control">
                                    <option value="">Please select...</option>
                                    @foreach($organizations as $organization)
                                        <option value="{{$organization->id}}" {{old('organization_id') == $organization->id ? 'selected' : ''}}>{{$organization->organization_name}}</option>
                                    @endforeach
                                </select>
                                @error('organization_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label">Ward</label>
                                <input list="wards" type="text"  name="ward" value="{{old('ward')}}" class="form-control{{ $errors->has('ward') ? ' is-invalid' : '' }}" >
                                <datalist id="wards">
                                    @foreach($wards as $ward)
                                        <option value="{{$ward->name}}"/>
                                    @endforeach
                                </datalist>
                                @error('ward')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            <div class="col-md-12">
                                <div class="float-left">
                                    <a class="btn btn-outline-secondary" href="{{route('genders.index')}}" title="create">cancel</a>
                                </div>
                                <div class="float-right">
                                    <input type="submit" class="btn btn-primary btn-lg" value="Save"/>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
