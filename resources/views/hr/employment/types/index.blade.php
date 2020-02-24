@extends('layouts.admin')
@section('title','Employment Types')
@section('content')

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-12">
                    <div class="float-left">
                        <h4 class="header-title">Employment Types</h4>
                    </div>
                    <div class="float-right">
                        @if(checkPermission('employmentType-create'))
                            <a class="btn btn-primary" href="#newCountry" data-toggle="modal"><i class="fa fa-plus"></i>New Employment Type</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            @include('alerts._flash')

            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm" id="table">
                    <thead class="text-uppercase text-center bg-blue">
                        <tr class="text-white">
                            <th scope="col">Name</th>
                            <th scope="col">Descriptions</th>
                            <th scope="col" >Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employmentTypes as $employmentType)
                            <tr>
                                <td class="text-left">{{$employmentType->name}}</td>
                                <td class="text-left">{{$employmentType->desc}}</td>
                                <td class="text-center p-0">
                                    <div class="btn btn-group">
                                        @if(checkPermission('employmentType-update'))
                                            <a class="btn btn-primary btn-sm mr-2" href="{{route('employmentTypes.edit',$employmentType['id'])}}" title="Edit"><i class="fa fa-edit"></i></a>
                                        @endif
                                        @if(checkPermission('employmentType-delete'))
                                            <form class="form-delete" method="post" action="{{route('employmentTypes.destroy',$employmentType['id'])}}">
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

    @if(checkPermission('employmentType-create'))
        <!-- start create new employmentType form modal -->
        <div class="modal fade" id="newCountry" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create new Employment Type</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{route('employmentTypes.store')}}" class="form-horizontal" role="form" id="employmentTypeForm" name="employmentTypeForm" autocomplete="off" >
                        @csrf
                        <div class="modal-body">

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="col-form-label">New Employment Type Name <span class="star">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" placeholder="Ex. Contract" required/>
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
        <!-- end create new employmentType form modal -->

    @endif

@endsection
