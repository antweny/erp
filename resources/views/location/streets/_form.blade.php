    @csrf
    <div class="form-group row">
        <div class="col-md-6">
            <label class="col-form-label">Street/Village Name <span class="star">*</span></label>
            <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }} " value="{{old('name',$street->name)}}" placeholder="Ex. Tanzania, Kenya" required/>
            @if ($errors->has('name'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('name') }}</strong></span>@endif
        </div>
        <div class="col-md-6">
            <label class="col-form-label">District</label>
            <select class="form-control @error('district_id') is-invalid @enderror single-select" style="width: 100%" name="district_id">
                <option value="">Select district...</option>
                @foreach($wards as $ward)
                    <option value="{{$ward->id}}" {{$street->ward_id == $ward->id ? 'selected' : ''}}>{{$ward->name}}</option>
                @endforeach
            </select>
            @error('district_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-12">
            <label class="col-form-label">Descriptions</label>
            <textarea name="desc" id="desc" class="form-control{{ $errors->has('desc') ? ' is-invalid' : '' }}" rows="5">{{old('desc',$street->desc)}}</textarea>
            @if ($errors->has('desc'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('desc') }}</strong></span>@endif
        </div>
    </div>

    <div class="form-group row justify-content-center">
        <div class="col-md-6 float-left">
            <a class="btn btn-dark" href="{{route('streets.index')}}">Cancel</a>
        </div>
        <div class="col-md-6">
            <div class="float-right">
                <input type="submit" class="btn btn-success" value="{{$buttonText}}"/>
            </div>
        </div>
    </div>
