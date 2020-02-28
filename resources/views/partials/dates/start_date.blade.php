<label class="col-form-label">{{$label ?? 'From date'}} </label>
<input type="text" id="start_date" name="start_date" value="{{old('start_date',$old)}}" class="form-control @error('start_date') is-invalid @enderror" >
@error('start_date')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
