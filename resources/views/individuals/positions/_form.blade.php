@csrf
<div class="form-group row">
    <div class="col-md-6">
        @include('partials.individuals.singleDropdown',['old'=>null ?? $position->individual_id])
    </div>
    <div class="col-md-6">
        <label  class="col-form-label">Position Title <span class="star">*</span></label>
        <input list="titles" type="text" name="title" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }} " value="{{old('title',$position->title->name)}}" placeholder="Ex. IT Manager, Member" required />
        <datalist id="titles">
            @foreach($titles as $title)
                <option value="{{$title->name}}"/>
            @endforeach
        </datalist>
        @if ($errors->has('title'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('title') }}</strong></span>@endif
    </div>

</div>

<div class="form-group row">
    <div class="col-md-6">
        @include('partials.organizations.singleDropdown',['old'=>null ?? $position->organization_id])
    </div>
    <div class="col-md-6">
        @include('partials.cities.dropdown',['old'=>null ?? $position->city_id])
    </div>
</div>

<div class="form-group row">
    <div class="col-md-6">
        @include('partials.districts.dropdown',['old'=>null ?? $position->district_id])
    </div>

    <div class="col-md-6">
        @include('partials.wards.dropdown',['old'=>null ?? $position->ward_id])
    </div>
</div>

<div class="form-group row">
    <div class="col-md-6">
        @include('partials.dates.start_date',['old'=>null ?? mysql_to_date($position->start_date)])
    </div>
    <div class="col-md-6">
        @include('partials.dates.end_date',['old'=>null ?? mysql_to_date($position->end_date)])
    </div>
</div>

<div class="form-group row">
    <div class="col-sm-12">
        <label class="col-form-label">Descriptions</label>
        <textarea name="desc" id="desc" class="form-control{{ $errors->has('desc') ? ' is-invalid' : '' }}" rows="5" id="editor">{{old('desc',$position->desc)}}</textarea>
        @if ($errors->has('desc'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('desc') }}</strong></span>@endif
    </div>
</div>

<div class="form-group row justify-content-center">
    <div class="col-md-12">
        <div class="float-left">
            <a class="btn btn-dark" href="{{route('positions.index')}}" title="create">cancel</a>
        </div>
        <div class="float-right">
            <input type="submit" class="btn btn-success" value="{{$buttonText}}"/>
        </div>
    </div>
</div>
