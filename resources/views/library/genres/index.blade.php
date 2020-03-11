@extends('layouts.templates.library')
@section('title','List of Book Genres')
@section('content')


    <div class="card">
        <div class="card-header">
            <div class="float-left">
                <h4 class="header-title">List of Book Genres</h4>
            </div>
            <div class="float-right">
                @can('genre-create')
                    <a class="btn btn-success" href="#newGenre" data-toggle="modal"><i class="fa fa-plus"></i> New Genre</a>
                @endcan
            </div>
        </div>
        <div class="card-body">
            @include('alerts._flash')
            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm" id="table">
                    <thead class="text-uppercase text-center">
                    <tr class="text-white">
                        <th scope="col">Name</th>
                        <th scope="col">Type</th>
                        <th scope="col">Descriptions</th>
                        <th scope="col" >Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($genres as $genre)
                        <tr>
                            <td class="text-center">{{$genre->name}}</td>
                            <td class="text-center">{{$genre->genre_type}}</td>
                            <td class="text-left">{{$genre->desc}}</td>
                            <td class="text-center p-0">
                                <div class="btn btn-group">

                                    @can('genre-update')
                                        <a class="btn btn-primary btn-sm mr-2" href="{{route('genres.edit',$genre->id)}}" title="Edit"><i class="fa fa-edit"></i></a>
                                    @endcan

                                    @can('genre-delete')
                                        <form class="form-delete" method="post" action="{{route('genres.destroy',$genre->id)}}">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fa fa-trash-alt"></i></button>
                                        </form>
                                    @endcan

                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @can('genre-create')
        <!-- start create new genre form modal -->
        <div class="modal fade" id="newGenre" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Genre</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{route('genres.store')}}" class="form-horizontal" role="form" id="genreForm" name="genreForm" >
                        @csrf
                        <div class="modal-body">

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="col-form-label">Genre Name/Number <span class="star">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" placeholder="Ex. Poetry, Self-Learning, Comedy" required/>
                                    @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="col-form-label">Genre Name/Number <span class="star">*</span></label>
                                    <select name="type" class="form-control @error('genre') is-invalid @enderror">
                                        <option value="">--Select Type--</option>
                                        <option value="F" {{old('genre') == 'F' ? 'selected' : ''}}>Fiction</option>
                                        <option value="NF" {{old('genre') == 'NF' ? 'selected' : ''}}>Non-Fiction</option>
                                    </select>
                                    @error('genre')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label class="col-form-label">Descriptions</label>
                                    <textarea name="desc" id="desc" class="form-control @error('desc') is-invalid @enderror" rows="5">{{old('desc')}}</textarea>
                                    @error('desc')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="btn-save">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end create new genre form modal -->
    @endcan

@endsection
