@csrf

<div class="form-group row">
    <div class="col-md-8">
        <label class="col-form-label">Topic Title <span class="star">*</span></label>
        <input type="text" name="topic" id="topic" class="form-control {{ $errors->has('topic') ? ' is-invalid' : '' }} " value="{{old('topic',$genderSeries->topic)}}" required/>
        @if ($errors->has('topic'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('topic') }}</strong></span>@endif
    </div>
    <div class="col-md-4">
        @include('partials.employees.coordinator',['old' => null ?? $genderSeries->coordinator])
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        @include('partials.individuals.facilitator',['old'=>null ?? $genderSeries->facilitator])
    </div>
    <div class="col-md-6">
        @include('partials.dates.date',['old'=>null ?? mysql_to_date($genderSeries->date)])
    </div>
</div>

<div class="form-group row">
    <div class="col-sm-12">
        <label class="col-form-label">Follow up</label>
        <textarea name="follow_up" id="follow_up" class="form-control{{ $errors->has('follow_up') ? ' is-invalid' : '' }}" rows="7">{{old('follow_up',$genderSeries->follow_up)}}</textarea>
        @if ($errors->has('follow_up'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('follow_up') }}</strong></span>@endif
    </div>
</div>

<div class="form-group row justify-content-center">
    <div class="col-md-12">
        <div class="float-left">
            <a class="btn btn-dark" href="{{route('genderSeries.index')}}" title="create">cancel</a>
        </div>
        <div class="float-right">
            <input type="submit" class="btn btn-success" value="{{$buttonText}}"/>
        </div>
    </div>
</div>
