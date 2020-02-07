    @csrf
    <div class="form-group row">
        <div class="col-md-12">
            <label class="col-form-label">Field Name <span class="star">*</span></label>
            <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }} " value="{{old('name',$field->name)}}" placeholder="Ex. Tanzania, Kenya" required/>
            @if ($errors->has('name'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('name') }}</strong></span>@endif
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-12">
            <label class="col-form-label">Pillar <span class="star">*</span></label>
            <select name="sector_id" class="form-control" required>
                <option value="">Select Sector....</option>
                @foreach($sectors as $sector)
                    <option value="{{$sector->id}}" {{ old('sector_id',$field->sector_id == $sector->id) ? 'selected' : ''}}>{{$sector->name}}</option>
                @endforeach
            </select>
            @if ($errors->has('sector_id'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('sector') }}</strong></span>@endif
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-12">
            <label class="col-form-label">Descriptions</label>
            <textarea name="desc" id="desc" class="form-control{{ $errors->has('desc') ? ' is-invalid' : '' }}" rows="5">{{old('desc',$field->desc)}}</textarea>
            @if ($errors->has('desc'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('desc') }}</strong></span>@endif
        </div>
    </div>

    <div class="form-group row justify-content-center">
        <div class="col-md-6 float-left">
            <a class="btn btn-outline-secondary" href="{{route('fields.index')}}">Cancel</a>
        </div>
        <div class="col-md-6">
            <div class="float-right">
                <input type="submit" class="btn btn-primary" value="{{$buttonText}}"/>
            </div>
        </div>
    </div>
