    @csrf
    <div class="form-group row">
        <div class="col-md-4">
            <label class="col-form-label">Venue Name <span class="star">*</span></label>
            <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }} " value="{{old('name',$venue->name)}}" placeholder="Ex. Tanzania, Kenya" required/>
            @if ($errors->has('name'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('name') }}</strong></span>@endif
        </div>
        <div class="col-md-4">
            <label class="col-form-label">Type</label>
            <select class="form-control @error('type') is-invalid @enderror" name="type">
                <option value="">Select Type...</option>
                <option value="Outdoor" {{old('type',$venue->type) == 'Outdoor' ? 'selected' : ''}}>Outdoor</option>
                <option value="Indoor" {{old('type',$venue->type) == 'Indoor' ? 'selected' : ''}}>Indoor</option>
            </select>
            @error('type')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
        <div class="col-md-4">
            <label class="col-form-label">Capacity</label>
            <input type="number" name="capacity" id="capacity" class="form-control @error('capacity') is-invalid @enderror" value="{{old('capacity',$venue->capacity)}}"  />
            @error('capacity')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-4">
            <label class="col-form-label">City</label>
            <select class="form-control @error('city_id') is-invalid @enderror single-select" style="width: 100%;"name="city_id">
                <option value="">Select city...</option>
                @foreach($cities as $city)
                    <option value="{{$city->id}}" {{old('city_id',$venue->city_id) == $city->id ? 'selected' : ''}}>{{$city->name}}</option>
                @endforeach
            </select>
            @error('city_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
        <div class="col-md-4">
            <label class="col-form-label">District</label>
            <select class="form-control @error('district_id') is-invalid @enderror single-select" style="width: 100%;" name="district_id">
                <option value="">Select district...</option>
                @foreach($districts as $district)
                    <option value="{{$district->id}}" {{old('district_id',$venue->district_id) == $district->id ? 'selected' : ''}}>{{$district->name}}</option>
                @endforeach
            </select>
            @error('district_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
        <div class="col-md-4">
            <label class="col-form-label">Mobile </label>
            <input type="number" name="mobile" id="mobile" class="form-control @error('mobile') is-invalid @enderror" value="{{old('mobile',$venue->mobile)}}"  />
            @error('mobile')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-4">
            <label class="col-form-label">Email </label>
            <input type="email" name="email" id="name" class="form-control @error('email') is-invalid @enderror" value="{{old('email',$venue->email)}}" />
            @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
        <div class="col-md-4">
            <label class="col-form-label">Contact Person Name </label>
            <input type="text" name="contact_person" id="contact_person" class="form-control @error('contact_person') is-invalid @enderror" value="{{old('contact_person',$venue->contact_person)}}"/>
            @error('contact_person')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
        <div class="col-md-4">
            <label class="col-form-label">Contact Person Number</label>
            <input type="number" name="contact_person_number" id="contact_person_number" class="form-control @error('contact_person_number') is-invalid @enderror" value="{{old('contact_person_number',$venue->contact_person_number)}}" />
            @error('contact_person_number')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-12">
            <label class="col-form-label">Descriptions</label>
            <textarea name="desc" id="desc" class="form-control{{ $errors->has('desc') ? ' is-invalid' : '' }}" rows="5">{{old('desc',$venue->desc)}}</textarea>
            @if ($errors->has('desc'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('desc') }}</strong></span>@endif
        </div>
    </div>

    <div class="form-group row justify-content-center">
        <div class="col-md-6 float-left">
            <a class="btn btn-dark" href="{{route('venues.index')}}">Cancel</a>
        </div>
        <div class="col-md-6">
            <div class="float-right">
                <input type="submit" class="btn btn-success" value="{{$buttonText}}"/>
            </div>
        </div>
    </div>
