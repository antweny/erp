@extends('layouts.templates.organizations')
@section('title','Sector Fields')
@section('content')


    <div class="card">
        <div class="card-header">
            <div class="float-left">
                <h4 class="header-title">Sector Fields</h4>
            </div>
            <div class="float-right">
                @can('field-create')
                    <a class="btn btn-success" href="#newField" data-toggle="modal"><i class="fa fa-plus"></i> New field</a>
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
                        <th scope="col">Sector</th>
                        <th scope="col">Descriptions</th>
                        <th scope="col" >Actions</th>
                    </tr>
                    {{ csrf_field() }}
                    </thead>
                    <tbody>
                        @foreach ($fields as $field)
                            <tr>
                                <td class="text-left">{{$field->name}}</td>
                                <td class="text-center">{{$field->slug}}</td>
                                <td class="text-center">{{$field->sector->name}}</td>
                                <td class="text-left">{{$field->desc}}</td>
                                <td class="text-center p-0">
                                    <div class="btn btn-group">

                                        @can('field-update')
                                            <a class="btn btn-primary btn-sm mr-2" href="{{route('fields.edit',$field->id)}}" title="Edit"><i class="fa fa-edit"></i></a>
                                        @endcan

                                        @can('field-delete')
                                            <form class="form-delete" method="post" action="{{route('fields.destroy',$field->id)}}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this field?')"><i class="fa fa-trash-alt"></i></button>
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

    @can('field-create')
        <!-- start create new field form modal -->
        <div class="modal fade" id="newField" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create new field</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{route('fields.store')}}" class="form-horizontal" role="form" id="fieldForm" name="fieldForm" autocomplete="off" >
                        @csrf
                        <div class="modal-body">

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="col-form-label">Field Name <span class="star">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }} " value="{{old('name')}}" placeholder="Ex. Nursing, Teachers" required/>
                                    @if ($errors->has('name'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('name') }}</strong></span>@endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                   @include('partials.sectors.dropdown',['old'=>null])
                                </div>

                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label class="col-form-label">Descriptions</label>
                                    <textarea name="desc" id="desc" class="form-control{{ $errors->has('desc') ? ' is-invalid' : '' }}" rows="5">{{old('desc')}}</textarea>
                                    @if ($errors->has('desc'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('desc') }}</strong></span>@endif
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
        <!-- end create new field form modal -->
    @endcan

@endsection
