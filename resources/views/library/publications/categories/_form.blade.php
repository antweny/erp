@csrf
<div class="form-group row">
    <div class="col-md-12">
        <label class="col-form-label">Publication Category Name <span class="star">*</span></label>
        <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }} " value="{{$publicationCategory->name}}" placeholder="Ex. Subject" required/>
        @if ($errors->has('name'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('name') }}</strong></span>@endif
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-12">
        <label class="col-form-label">Descriptions</label>
        <textarea name="desc" id="desc" class="form-control{{ $errors->has('desc') ? ' is-invalid' : '' }}" rows="5">{{$publicationCategory->desc}}</textarea>
        @if ($errors->has('desc'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('desc') }}</strong></span>@endif
    </div>
</div>

<div class="form-group row justify-content-center">
    <div class="col-md-6 float-left">
        <a class="btn btn-dark" href="{{route('publicationCategories.index')}}">Cancel</a>
    </div>
    <div class="col-md-6">
        <div class="float-right">
            <input type="submit" class="btn btn-success" value="{{$buttonText}}"/>
        </div>
    </div>
</div>
