@csrf
<div class="form-group row">
    <div class="col-md-6">
        <label class="col-form-label">Full Name <span class="star">*</span></label>
        <input  type="text" name="full_name" class="form-control{{ $errors->has('full_name') ? ' is-invalid' : '' }}"  value="{{old('full_name',$individual->full_name)}}" required>
        @if ($errors->has('full_name'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('full_name') }}</strong></span>@endif
    </div>
    <div class="col-md-6">
        <label class="col-form-label">Gender</label>
        <select class="form-control @error('gender') is-invalid @enderror" name="gender">
            <option value="">Select...</option>
            <option value="M" {{old('gender',$individual->gender) == 'M' ? 'selected' : ''}}>Male</option>
            <option value="F" {{old('gender',$individual->gender) == 'F' ? 'selected' : ''}}>Female</option>
        </select>
        @error('gender')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
</div>

<div class="form-group row">
    <div class="col-md-6">
        <label class="col-form-label">Age Group</label>
        <select class="form-control @error('age_group') is-invalid @enderror" name="age_group">
            <option value="">Select...</option>
            <option value="13-17" {{old('age_group',$individual->age_group) == '13-17' ? 'selected' : ''}}>13-17</option>
            <option value="18-25" {{old('age_group',$individual->age_group) == '18-25' ? 'selected' : ''}}>18-25</option>
            <option value="26-35" {{old('age_group',$individual->age_group) == '26-35' ? 'selected' : ''}}>26-35</option>
            <option value="36-45" {{old('age_group',$individual->age_group) == '36-45' ? 'selected' : ''}}>36-45</option>
            <option value="46-55" {{old('age_group',$individual->age_group) == '46-55' ? 'selected' : ''}}>46-55</option>
            <option value="55+" {{old('age_group',$individual->age_group) == '55+' ? 'selected' : ''}}>55 Above</option>
        </select>
        @error('age_group')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="col-md-6">
        <label class="col-form-label">Occupation</label>
        <input type="text" class="form-control{{ $errors->has('occupation') ? ' is-invalid' : '' }}" name="occupation" value="{{old('occupation',$individual->occupation)}}" />
        @if ($errors->has('occupation'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('occupation') }}</strong></span>@endif
    </div>
</div>

<div class="form-group row">
    <div class="col-md-6">
        <label class="col-form-label">Education Level</label>
        <select class="form-control @error('education_level_id') is-invalid @enderror" name="education_level_id">
            <option value="">Select region...</option>
            @foreach($levels as $level)
                <option value="{{$level->id}}" {{old('education_level_id',$individual->education_level_id) == $level->id ? 'selected' : ''}}>{{$level->name}}</option>
            @endforeach
        </select>
        @error('education_level_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="col-md-6">
        <label class="col-form-label">Mobile Number</label>
        <input type="text" name="mobile" class="form-control {{ $errors->has('mobile') ? ' is-invalid' : '' }} " value="{{old('mobile',$individual->mobile)}}" placeholder="Ex: 0784000000"/>
        @if ($errors->has('mobile'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('mobile') }}</strong></span>@endif
    </div>
</div>

<div class="form-group row">
    <div class="col-md-6">
        <label class="col-form-label">City/Region</label>
        <input list="cities" type="text" name="city" class="form-control {{ $errors->has('city') ? ' is-invalid' : '' }} " value="{{old('city',$individual->city->name)}}" placeholder="Ex. Kigoma, Lindi" />
        <datalist id="cities">
            @foreach($cities as $city)
                <option value="{{$city->name}}"/>
            @endforeach
        </datalist>
        @if ($errors->has('city'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('city') }}</strong></span>@endif
    </div>
    <div class="col-md-6">
        <label class="col-form-label">District</label>
        <input list="districts" type="text" name="district" class="form-control {{ $errors->has('district') ? ' is-invalid' : '' }} " value="{{old('district',$individual->district->name)}}" placeholder="Ex. Ubungo, Hai, Kibaha" />
        <datalist id="districts">
            @foreach($districts as $district)
                <option value="{{$district->name}}"/>
            @endforeach
        </datalist>
        @if ($errors->has('district'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('district') }}</strong></span>@endif
    </div>
</div>

<div class="form-group row">
    <div class="col-md-6">
        <label class="col-form-label" name="ward">Wards</label>
        <input list="wards" type="text" name="ward" class="form-control {{ $errors->has('ward') ? ' is-invalid' : '' }} " value="{{old('ward',$individual->ward->name)}}" placeholder="Ex. Mabibo, Makumbusho" />
        <datalist id="wards">
            @foreach($wards as $ward)
                <option value="{{$ward->name}}"/>
            @endforeach
        </datalist>
        @if ($errors->has('ward'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('ward') }}</strong></span>@endif
    </div>
    <div class="col-md-6">
        <label class="col-form-label">Email</label>
        <input type="email" name="email" id="date" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{old('email',$individual->email)}}">
        @if ($errors->has('email'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('email') }}</strong></span>@endif
    </div>
</div>

<div class="form-group row">
    <div class="col-md-12">
        <label class="col-form-label">Address</label>
        <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" rows="1">{{old('address',$individual->address)}}</textarea>
        @error('address')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        @if ($errors->has('address'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('address') }}</strong></span>@endif
    </div>
</div>

<div class="form-group row justify-content-center">
    <div class="col-md-6 float-left">
        <a class="btn btn-outline-secondary" href="{{route('individuals.index')}}">Cancel</a>
    </div>
    <div class="col-md-6">
        <div class="float-right">
            <input type="submit" class="btn btn-primary" value="{{$buttonText}}"/>
        </div>
    </div>
</div>

