    @csrf
    <div class="form-group row">
        <div class="col-md-4">
            <label class="col-form-label">Country Name <span class="star">*</span></label>
            <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }} " value="{{old('name',$country->name)}}" placeholder="Ex. Tanzania, Kenya" required/>
            @if ($errors->has('name'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('name') }}</strong></span>@endif
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-12">
            <label class="col-form-label">Descriptions</label>
            <textarea name="desc" id="desc" class="form-control{{ $errors->has('desc') ? ' is-invalid' : '' }}" rows="5">{{old('desc',$country->desc)}}</textarea>
            @if ($errors->has('desc'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('desc') }}</strong></span>@endif
        </div>
    </div>

    <div class="form-group row justify-content-center">
        <div class="col-md-6 float-left">
            <a class="btn btn-outline-secondary" href="{{route('countries.index')}}">Cancel</a>
        </div>
        <div class="col-md-6">
            <div class="float-right">
                <input type="submit" class="btn btn-primary" value="{{$buttonText}}"/>
            </div>
        </div>
    </div>
