@csrf
<div class="form-group row">
    <div class="col-md-12">
        <label class="col-form-label">Genre Name <span class="star">*</span></label>
        <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }} " value="{{$genre->name}}" placeholder="Ex. Subject" required/>
        @if ($errors->has('name'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('name') }}</strong></span>@endif
    </div>
</div>
<div class="form-group row">
    <div class="col-md-12">
        <label class="col-form-label">Genre Name/Number <span class="star">*</span></label>
        <select name="type" class="form-control @error('genre') is-invalid @enderror">
            <option value="">--Select Type--</option>
            <option value="F" {{$genre->type == 'F' ? 'selected' : ''}}>Fiction</option>
            <option value="NF" {{$genre->type == 'NF' ? 'selected' : ''}}>Non-Fiction</option>
        </select>
        @error('genre')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-12">
        <label class="col-form-label">Descriptions</label>
        <textarea name="desc" id="desc" class="form-control{{ $errors->has('desc') ? ' is-invalid' : '' }}" rows="5">{{$genre->desc}}</textarea>
        @if ($errors->has('desc'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('desc') }}</strong></span>@endif
    </div>
</div>

<div class="form-group row justify-content-center">
    <div class="col-md-6 float-left">
        <a class="btn btn-dark" href="{{route('genres.index')}}">Cancel</a>
    </div>
    <div class="col-md-6">
        <div class="float-right">
            <input type="submit" class="btn btn-success" value="{{$buttonText}}"/>
        </div>
    </div>
</div>
