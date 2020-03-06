@csrf
<div class="form-group row">
    <div class="col-md-12">
        <label class="col-form-label">Publisher Name <span class="star">*</span></label>
        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{$publisher->name}}" required/>
        @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
</div>
<div class="form-group row">
    <div class="col-md-12">
        <label class="col-form-label">Mobile </label>
        <input type="text" name="mobile" id="mobile" class="form-control @error('mobile') is-invalid @enderror" value="{{$publisher->mobile}}" />
        @error('mobile')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
</div>
<div class="form-group row">
    <div class="col-md-12">
        <label class="col-form-label">Address </label>
        <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="2">{{$publisher->address}}</textarea>
        @error('address')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
</div>
<div class="form-group row">
    <div class="col-md-12">
        <label class="col-form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{$publisher->email}}"/>
        @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
</div>
<div class="form-group row">
    <div class="col-md-12">
        <label class="col-form-label">Website</label>
        <input type="website" name="website" id="website" class="form-control @error('website') is-invalid @enderror" value="{{$publisher->website}}"/>
        @error('website')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
</div>

<div class="form-group row justify-content-center">
    <div class="col-md-6 float-left">
        <a class="btn btn-dark" href="{{route('publishers.index')}}">Cancel</a>
    </div>
    <div class="col-md-6">
        <div class="float-right">
            <input type="submit" class="btn btn-success" value="{{$buttonText}}"/>
        </div>
    </div>
</div>
