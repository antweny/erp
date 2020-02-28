<label class="col-form-label">{{$label ?? 'Date'}}</label>
<input type="text" id="date" name="date" value="{{old('date',$old)}}" class="form-control @error('date') is-invalid @enderror" >
@error('date')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
