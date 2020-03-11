@extends('layouts.templates.individuals')
@section('title','Education Levels')
@section('content')


    <div class="card">
        <div class="card-header">
            <div class="float-left">
                <h4 class="header-title">Education Levels</h4>
            </div>
            <div class="float-right">
                @can('educationLevel-create')
                    <a class="btn btn-success" href="#newEducationLevel" data-toggle="modal"><i class="fa fa-plus"></i> New education level</a>
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
                        @foreach ($educationLevels as $educationLevel)
                            <tr>
                                <td class="text-left">{{$educationLevel->name}}</td>
                                <td class="text-center">{{$educationLevel->slug}}</td>
                                <td class="text-left">{{$educationLevel->desc}}</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        @can('educationLevel-update')
                                            <a class="btn btn-primary btn-sm mr-2" href="{{route('educationLevels.edit',$educationLevel->id)}}" title="Edit"><i class="fa fa-edit"></i></a>
                                        @endcan
                                        @can('educationLevel-delete')
                                            <form class="form-delete" method="post" action="{{route('educationLevels.destroy',$educationLevel->id)}}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure delete education level {{$educationLevel->name}}?')" title="delete"><i class="fa fa-trash-alt"></i></button>
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

    @can('educationLevel-create')
        <!-- start create new certificate form modal -->
        <div class="modal fade" id="newEducationLevel" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Education Level</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{route('educationLevels.store')}}" class="form-horizontal" role="form" id="educationLevelForm" name="educationLevelForm" autocomplete="off" >
                        @csrf
                        <div class="modal-body">

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="col-form-label">Education Level Name <span class="star">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }} " value="{{old('name')}}" placeholder="Ex. Degree, Master's" required/>
                                    @if ($errors->has('name'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('name') }}</strong></span>@endif
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
                            <button type="submit" class="btn btn-success" id="btn-save">save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end create new certificate form modal -->
    @endcan

@endsection
