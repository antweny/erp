@extends('layouts.templates.organizations')
@section('title','Organization Categories')
@section('content')


    <div class="card">
        <div class="card-header">
            <div class="float-left">
                <h4 class="header-title">Organization Categories</h4>
            </div>
            <div class="float-right">
                @can('organizationCategory-create')
                    <a class="btn btn-success" href="#newOrganizationCategory" data-toggle="modal"><i class="fa fa-plus"></i> New organization category</a>
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
                        <th scope="col">Slug</th>
                        <th scope="col">Descriptions</th>
                        <th scope="col" >Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($organizationCategories as $organizationCategory)
                        <tr>
                            <td class="text-left">{{$organizationCategory->name}}</td>
                            <td class="text-center">{{$organizationCategory->slug}}</td>
                            <td class="text-left">{{$organizationCategory->desc}}</td>
                            <td class="text-center p-0">
                                <div class="btn btn-group">
                                    @if(checkPermission('organizationCategory-update'))
                                        <a class="btn btn-primary btn-sm mr-2" href="{{route('categories.edit',$organizationCategory->id)}}" title="Edit"><i class="fa fa-edit"></i></a>
                                    @endif

                                    @if(checkPermission('organizationCategory-delete'))
                                        <form class="form-delete" method="post" action="{{route('categories.destroy',$organizationCategory->id)}}">
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

    @can('organizationCategory-create')
        <!-- start create new organizationCategory form modal -->
        <div class="modal fade" id="newOrganizationCategory" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create new organization category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{route('categories.store')}}" class="form-horizontal" role="form" id="organizationCategoryForm" name="organizationCategoryForm" >
                        @csrf
                        <div class="modal-body">

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="col-form-label">Organization Category Name <span class="star">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" placeholder="Ex. Public Learning Institution" required/>
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
        <!-- end create new organizationCategory form modal -->
    @endcan

@endsection
