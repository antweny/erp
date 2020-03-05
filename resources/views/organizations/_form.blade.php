<div class="form-group row">
    <div class="col-md-4">
        <label class="col-form-label">Organization Name <span class="star">*</span></label>
        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name',$organization->name)}}" placeholder="Ex. TGNP Mtandao, Vodacom" required/>
        @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="col-md-4">
        <label class="col-form-label">Acronym </label>
        <input type="text" name="acronym" id="acronym" class="form-control @error('acronym') is-invalid @enderror" value="{{old('acronym',$organization->acronym)}}" />
        @error('acronym')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="col-md-4">
        <label class="col-form-label">Category </label>
        <select name="organization_category_id" class="form-control @error('organization_category_id') is-invalid @enderror single-select">
            <option value="">Select....</option>
            @foreach($categories as $category)
                <option value="{{$category->id}}" {{old('organization_category_id',$organization->organization_category_id) == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
            @endforeach
        </select>
        @error('organization_category_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
</div>

<div class="form-group row">
    <div class="col-md-4">
        <label class="col-form-label">Operational Level </label>
        <select name="operation_level" class="form-control @error('operation_level') is-invalid @enderror" >
            <option value="">Select....</option>
            <option value="CL" {{old('operation_level ',$organization->operation_level) == 'CL' ? 'selected' : ''}}>Community Level</option>
            <option value="DL" {{old('operation_level',$organization->operation_level) == 'DL' ? 'selected' : ''}}>District Level</option>
            <option value="REL" {{old('operation_level',$organization->operation_level) == 'REL' ? 'selected' : ''}}>Region Level</option>
            <option value="NL" {{old('operation_level',$organization->operation_level) == 'NL' ? 'selected' : ''}}>National Level</option>
            <option value="RL" {{old('operation_level',$organization->operation_level) == 'RL' ? 'selected' : ''}} >Regional Level</option>
            <option value="IL" {{old('operation_level',$organization->operation_level) == 'IL' ? 'selected' : ''}}>International Level</option>
        </select>
        @error('operation_level')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="col-md-4">
        <label class="col-form-label">Founded</label>
        <input type="number" name="founded" id="founded" class="form-control @error('founded') is-invalid @enderror" value="{{old('founded',$organization->founded)}}" />
        @error('founded')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="col-md-4">
        <label class="col-form-label">Registered</label>
        <input type="number" name="registered" id="registered" class="form-control @error('registered') is-invalid @enderror" value="{{old('registered',$organization->registered)}}" />
        @error('registered')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
</div>

<div class="form-group row">


</div>

<div class="form-group row">
    <div class="col-md-4">
        <label class="col-form-label">Contact Person Name </label>
        <input type="text" name="contact_person" id="contact_person" class="form-control @error('contact_person') is-invalid @enderror" value="{{old('contact_person',$organization->contact_person)}}"/>
        @error('contact_person')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="col-md-4">
        <label class="col-form-label">Contact Person Number</label>
        <input type="text" name="contact_person_number" id="contact_person_number" class="form-control @error('contact_person_number') is-invalid @enderror" value="{{old('contact_person_number',$organization->contact_person_number)}}" />
        @error('contact_person_number')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="col-md-4">
        @include('partials.cities.dropdown',['old'=>null ?? $organization->city_id])
    </div>
</div>


<div class="form-group row">
    <div class="col-md-4">
        @include('partials.districts.dropdown',['old'=>null ?? $organization->district_id])
    </div> 
    <div class="col-md-4">
        @include('partials.wards.dropdown',['old'=>null ?? $organization->ward_id])
    </div>
    <div class="col-md-4">
        <label class="col-form-label">Website </label>
        <input type="text" name="website" id="website" class="form-control @error('website') is-invalid @enderror" value="{{old('website',$organization->website)}}" placeholder="ex. http://www.company.com" />
        @error('website')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
</div>

<div class="form-group row">
    <div class="col-md-4">
        <label class="col-form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email',$organization->email)}}" />
        @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="col-md-4">
        <label class="col-form-label">Mobile 1 </label>
        <input type="number" name="mobile" id="mobile" class="form-control @error('mobile') is-invalid @enderror" value="{{old('mobile',$organization->mobile)}}" />
        @error('mobile')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="col-md-4">
        <label class="col-form-label">Telephone</label>
        <input type="number" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{old('phone',$organization->phone)}}" />
        @error('phone')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
</div>

<div class="form-group row">
    <div class="col-md-6">
        <label class="col-form-label">Address</label>
        <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" rows="5">{{old('address',$organization->address)}}</textarea>
        @error('address')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="col-md-6">
        <label class="col-form-label">Objectives</label>
        <textarea name="objectives" id="objectives" class="form-control @error('objectives') is-invalid @enderror" rows="5">{{old('objectives',$organization->objectives)}}</textarea>
        @error('objectives')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
</div>




<div class="form-group row justify-content-center">
    <div class="col-md-6 float-left">
        <a class="btn btn-dark" href="{{route('organizations.index')}}">Cancel</a>
    </div>
    <div class="col-md-6">
        <div class="float-right">
            <input type="submit" class="btn btn-success" value="{{$buttonText}}"/>
        </div>
    </div>
</div>

