@extends('layouts.templates.library')
@section('title','List of Authors')
@section('content')

    <div class="card">
        <div class="card-header">
            <div class="float-left">
                <h4 class="header-title">List of Authors</h4>
            </div>
            <div class="float-right">
                @can('author-create')
                    <a class="btn btn-success" href="#newAuthor" data-toggle="modal"><i class="fa fa-plus"></i> New Author</a>
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
                            <th scope="col">Address</th>
                            <th scope="col">Mobile</th>
                            <th scope="col" >Email</th>
                            <th scope="col" >Website</th>
                            <th scope="col" >Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($authors as $author)
                            <tr>
                                <td class="text-left">{{$author->name}}</td>
                                <td class="text-center">{{$author->address}}</td>
                                <td class="text-center">{{$author->mobile}}</td>
                                <td class="text-center">{{$author->email}}</td>
                                <td class="text-center"><a href="{{$author->website}}" target="_blank">{{$author->website}}</a> </td>
                                <td class="text-center p-0">
                                    <div class="btn btn-group">
                                        @if(checkPermission('author-update'))
                                            <a class="btn btn-primary btn-sm mr-2" href="{{route('authors.edit',$author['id'])}}" title="Edit"><i class="fa fa-edit"></i></a>
                                        @endif
                                        @if(checkPermission('author-delete'))
                                            <form class="form-delete" method="post" action="{{route('authors.destroy',$author['id'])}}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fa fa-trash-alt"></i></button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @can('author-create')
        <!-- start create new author form modal -->
        <div class="modal fade" id="newAuthor" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New author</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{route('authors.store')}}" class="form-horizontal" role="form" id="authorForm" name="authorForm" autocomplete="off" >
                        @csrf
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="col-form-label">Author Name <span class="star">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" required/>
                                    @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="col-form-label">Mobile </label>
                                    <input type="text" name="mobile" id="mobile" class="form-control @error('mobile') is-invalid @enderror" value="{{old('mobile')}}" />
                                    @error('mobile')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="col-form-label">Address </label>
                                    <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="2">{{old('address')}}</textarea>
                                    @error('address')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="col-form-label">Email</label>
                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}"/>
                                    @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="col-form-label">Website</label>
                                    <input type="website" name="website" id="website" class="form-control @error('website') is-invalid @enderror" value="{{old('website')}}"/>
                                    @error('website')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success" id="btn-save">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end create new author form modal -->
    @endcan

@endsection
