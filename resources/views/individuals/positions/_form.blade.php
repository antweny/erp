@csrf
<div class="form-group row">
    <div class="col-md-6">
        <label class="col-form-label">Individual Name <span class="star">*</span> </label>
        <select name="individual_id" class="form-control @error('individual_id') is-invalid @enderror single-select" required>
            <option value="">Select Name....</option>
            @foreach($individuals as $individual)
                <option value="{{$individual->id}}" {{old('individual_id',$position->individual_id) == $individual->id ? 'selected' : ''}}>{{$individual->full_name}}</option>
            @endforeach
        </select>
        @error('individual_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="col-md-6">
        <label  class="col-form-label">Position Title <span class="star">*</span></label>
        <input list="cities" type="text" name="title" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }} " value="{{old('title',$position->title->name)}}" placeholder="Ex. IT Manager, Member" required />
        <datalist id="cities">
            @foreach($titles as $title)
                <option value="{{$title->name}}"/>
            @endforeach
        </datalist>
        @if ($errors->has('title'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('title') }}</strong></span>@endif
    </div>

</div>


<div class="form-group row">
    <div class="col-md-12">
        <label name="individual" class="col-form-label">Organization Name <span class="star">*</span></label>
        <select name="organization_id" class="form-control @error('organization_id') is-invalid @enderror  single-select" required>
            <option value="">Select Organization....</option>
            @foreach($organizations as $organization)
                <option value="{{$organization->id}}" {{old('organization_id',$position->organization_id) == $organization->id ? 'selected' : ''}}>{{$organization->organization_name}}</option>
            @endforeach
        </select>
        @error('organization_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
</div>


<div class="form-group row">
    <div class="col-md-4">
        <label  class="col-form-label">City/Region</label>
        <input list="cities" type="text" name="city" class="form-control {{ $errors->has('city') ? ' is-invalid' : '' }} " value="{{old('city',$position->city->name)}}" placeholder="Ex. Kigoma, Lindi" />
        <datalist id="cities">
            @foreach($cities as $city)
                <option value="{{$city->name}}"/>
            @endforeach
        </datalist>
        @if ($errors->has('city'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('city') }}</strong></span>@endif
    </div>

    <div class="col-md-4">
        <label class="col-form-label">District</label>
        <input list="districts" type="text" name="district" class="form-control {{ $errors->has('district') ? ' is-invalid' : '' }} " value="{{old('district',$position->district->name)}}" placeholder="Ex. Ubungo, Hai, Kibaha" />
        <datalist id="districts">
            @foreach($districts as $district)
                <option value="{{$district->name}}"/>
            @endforeach
        </datalist>
        @if ($errors->has('district'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('district') }}</strong></span>@endif
    </div>

    <div class="col-md-4">
        <label class="col-form-label">Wards</label>
        <input list="wards" type="text" name="ward" class="form-control {{ $errors->has('ward') ? ' is-invalid' : '' }} " value="{{old('ward',$position->ward->name)}}" placeholder="Ex. Mabibo, Makumbusho" />
        <datalist id="wards">
            @foreach($wards as $ward)
                <option value="{{$ward->name}}"/>
            @endforeach
        </datalist>
        @if ($errors->has('ward'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('ward') }}</strong></span>@endif
    </div>
</div>


<div class="form-group row">
    <div class="col-md-6">
        <label class="col-form-label">From date</label>
        <input type="text" id="start_date" name="start_date" value="{{old('start_date',mysql_to_date($position->start_date))}}" class="form-control @error('start_date') is-invalid @enderror" >
        @error('start_date')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="col-md-6">
        <label class="col-form-label">To date</label>
        <input type="text" id="end_date" name="end_date" value="{{old('end_date',mysql_to_date($position->end_date))}}" class="form-control" >
        @error('end_date')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
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
            <a class="btn btn-outline-secondary" href="{{route('positions.index')}}" title="create">cancel</a>
        </div>
        <div class="float-right">
            <input type="submit" class="btn btn-primary btn-lg" value="{{$buttonText}}"/>
        </div>
    </div>
</div>
