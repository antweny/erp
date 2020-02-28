@extends('layouts.templates.hrm')
@section('title','Designations')
@section('content')

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-12">
                    <div class="float-left">
                        <h4 class="header-title">Designations List</h4>
                    </div>
                    <div class="float-right">
                        @can('designation-create')
                            <a class="btn btn-success" href="#newCountry" data-toggle="modal"><i class="fa fa-plus"></i>New Designation</a>
                        @endcan
                    </div>
                </div>
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
                        @foreach ($designations as $designation)
                            <tr>
                                <td class="text-left">{{$designation->name}}</td>
                                <td class="text-left">{{$designation->desc}}</td>
                                <td class="text-center p-0">
                                    <div class="btn btn-group">
                                        @if(checkPermission('designation-update'))
                                            <a class="btn btn-primary btn-sm mr-2" href="{{route('designations.edit',$designation['id'])}}" title="Edit"><i class="fa fa-edit"></i></a>
                                        @endif
                                        @if(checkPermission('designation-delete'))
                                            <form class="form-delete" method="post" action="{{route('designations.destroy',$designation['id'])}}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete Confirmation?')"><i class="fa fa-trash-alt"></i></button>
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

    @if(checkPermission('designation-create'))
        <!-- start create new designation form modal -->
        <div class="modal fade" id="newCountry" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create new Designation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{route('designations.store')}}" class="form-horizontal" role="form" id="designationForm" name="designationForm" autocomplete="off" >
                        @csrf
                        <div class="modal-body">

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="col-form-label">Designation Name <span class="star">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" placeholder="Ex. Information and Comunication PO" required/>
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
                            <button type="submit" class="btn btn-success" id="btn-save">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end create new designation form modal -->

    @endif

@endsection
