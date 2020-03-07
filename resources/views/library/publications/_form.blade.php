@csrf
<div class="form-group row">
    <div class="col-md-9">
        <label class="col-form-label">Publication Title <span class="star">*</span> </label>
        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{old('title',$publication->title)}}" required></input>
        @error('title')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="col-md-3">
        <label class="col-form-label">Year </label>
        <select name="year" class="custom-select form-control @error('year') is-invalid @enderror single-select">
            <option value=""></option>
            @for($year = date('Y') ; $year > 1900; $year--)
                <option value="{{$year}}" {{ old('year',$publication->year) == $year ? 'selected' : ''}}>{{$year}}</option>
            @endfor
        </select>
        @error('year')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
</div>

<div class="form-group row">
    <div class="col-md-4">
        <label class="col-form-label">Category </label>
        <select name="publication_category_id" class="form-control @error('publication_category_id') is-invalid @enderror  single-select" >
            <option value="">--Select Author--</option>
            @foreach($categories as $category)
                <option value="{{$category->id}}" {{old('publication_category_id',$publication->publication_category_id) == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
            @endforeach
        </select>
        @error('publication_category_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="col-md-4">
        <label class="col-form-label">Author </label>
        <select name="author_id" class="form-control @error('author_id') is-invalid @enderror  single-select" >
            <option value="">--Select Author--</option>
            @foreach($authors as $author)
                <option value="{{$author->id}}" {{old('author_id',$publication->author_id) == $author->id ? 'selected' : '' }}>{{$author->name}}</option>
            @endforeach
        </select>
        @error('author_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="col-md-4">
        <label class="col-form-label">Publisher </label>
        <select name="publisher_id" class="form-control @error('publisher_id') is-invalid @enderror single-select" >
            <option value="">--Select Publisher--</option>
            @foreach($publishers as $publisher)
                <option value="{{$publisher->id}}" {{old('publisher_id',$publication->publisher_id) == $publisher->id ? 'selected' : '' }}>{{$publisher->name}}</option>
            @endforeach
        </select>
        @error('publisher_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
</div>

<div class="form-group row">
    <div class="col-md-4">
        <label class="col-form-label">Class Number </label>
        <input type="text" name="class_number" class="form-control @error('class_number') is-invalid @enderror" value="{{old('class_number',$publication->class_number)}}" ></input>
        @error('class_number')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="col-md-4">
        <label class="col-form-label">Shelf </label>
        <select name="shelf_id" class="form-control @error('shelf_id') is-invalid @enderror  single-select" >
            <option value="">--Select Shelf--</option>
            @foreach($shelves as $shelf)
                <option value="{{$shelf->id}}" {{old('shelf_id',$publication->shelf_id) == $shelf->id ? 'selected' : '' }}>{{$shelf->name}}</option>
            @endforeach
        </select>
        @error('shelf_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="col-md-4">
        <label class="col-form-label">Genre </label>
        <select name="genre_id" class="form-control @error('genre_id') is-invalid @enderror single-select" >
            <option value="">--Select Genre--</option>
            @foreach($genres as $genre)
                <option value="{{$genre->id}}" {{old('genre_id',$publication->genre_id) == $genre->id ? 'selected' : '' }}>{{$genre->name}}</option>
            @endforeach
        </select>
        @error('genre_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
</div>

<div class="form-group row">
    <div class="col-sm-12">
        <label class="col-form-label">Descriptions</label>
        <textarea name="desc" id="desc" class="form-control{{ $errors->has('desc') ? ' is-invalid' : '' }}" rows="5">{{old('desc',$publication->desc)}}</textarea>
        @if ($errors->has('desc'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('desc') }}</strong></span>@endif
    </div>
</div>

<div class="form-group row justify-content-center">
    <div class="col-md-6 float-left">
        <a class="btn btn-dark" href="{{route('publications.index')}}">Cancel</a>
    </div>
    <div class="col-md-6">
        <div class="float-right">
            <input type="submit" class="btn btn-success" value="{{$buttonText}}"/>
        </div>
    </div>
</div>


