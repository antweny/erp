@extends('layouts.templates.library')
@section('title','Publication Categories')
@section('content')


    <div class="card">
        <div class="card-header">
            <div class="float-left">
                <h4 class="header-title">Publication Categories</h4>
            </div>
            <div class="float-right">
                @can('publicationCategory-create')
                    <a class="btn btn-success" href="#newPublicationCategory" data-toggle="modal"><i class="fa fa-plus"></i> New publication category</a>
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
                        <th scope="col">Descriptions</th>
                        <th scope="col" >Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($publicationCategories as $publicationCategory)
                        <tr>
                            <td class="text-left">{{$publicationCategory->name}}</td>
                            <td class="text-left">{{$publicationCategory->desc}}</td>
                            <td class="text-center p-0">
                                <div class="btn btn-group">
                                    @if(checkPermission('publicationCategory-update'))
                                        <a class="btn btn-primary btn-sm mr-2" href="{{route('publicationCategories.edit',$publicationCategory->id)}}" title="Edit"><i class="fa fa-edit"></i></a>
                                    @endif

                                    @if(checkPermission('publicationCategory-delete'))
                                        <form class="form-delete" method="post" action="{{route('publicationCategories.destroy',$publicationCategory->id)}}">
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

    @can('publicationCategory-create')
        <!-- start create new publicationCategory form modal -->
        <div class="modal fade" id="newPublicationCategory" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New publication category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{route('publicationCategories.store')}}" class="form-horizontal" role="form" id="publicationCategoryForm" name="publicationCategoryForm" >
                        @csrf
                        <div class="modal-body">

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="col-form-label">Publication Category Name <span class="star">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" placeholder="Ex. Subject, Report" required/>
                                    @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
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
        <!-- end create new publicationCategory form modal -->
    @endcan

@endsection
