@extends('layouts.location')
@section('title','Streets')
@section('content')

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-12">
                    <div class="float-left">
                        <h4 class="header-title">Streets</h4>
                    </div>
                    <div class="float-right">
                        @can('street-import')
                            <a class="btn btn-secondary mr-4 " href="#import" data-toggle="modal"><i class="fa fa-plus"></i> Import</a>
                        @endcan
                        @can('street-create')
                            <a class="btn btn-primary" href="#newStreet" data-toggle="modal"><i class="fa fa-plus"></i> New street</a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            @include('alerts._flash')

            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm" id="table">
                    <thead class="text-uppercase text-center bg-primary bg-primary">
                    <tr class="text-white">
                        <th scope="col">Name</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Ward</th>
                        <th scope="col">Descriptions</th>
                        <th scope="col" >Actions</th>
                    </tr>
                    {{ csrf_field() }}
                    </thead>
                    <tbody>
                        @foreach ($streets as $street)
                            <tr>
                                <td class="text-left">{{$street->name}}</td>
                                <td class="text-center">{{$street->slug}}</td>
                                <td class="text-center">{{$street->ward->name}}</td>
                                <td class="text-left">{{$street->desc}}</td>
                                <td class="text-center ">
                                    <div class="btn-group">

                                        @can('street-update')
                                            <a class="btn btn-primary btn-sm mr-3" href="{{route('streets.edit',$street)}}" title="Edit"><i class="fa fa-edit"></i></a>
                                        @endcan

                                        @can('street-delete')
                                            <form class="form-delete" method="post" action="{{route('streets.destroy',$street)}}">
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

    @can('street-create')
        <!-- start create new district form modal -->
        <div class="modal fade" id="newStreet" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create new street</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{route('streets.store')}}" class="form-horizontal" role="form" id="streetForm" name="streetForm" autocomplete="off" >
                        @csrf
                        <div class="modal-body">

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="col-form-label">Street/Village Name <span class="star">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" placeholder="Ex. Mabibo, Goba" required/>
                                    @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="col-form-label">Ward</label>
                                    <select class="form-control @error('ward_id') is-invalid @enderror" name="ward_id">
                                        <option value="">Select street...</option>
                                        @foreach($wards as $ward)
                                            <option value="{{$ward->id}}" {{old('ward_id') == $ward->id ? 'selected' : ''}}>{{$ward->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('ward_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
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
        <!-- end create new district form modal -->
    @endcan



    @can('street-import')
        <!-- start create new permission form modal -->
        <div class="modal fade" id="import" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import streets</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{route('streets.import')}}" class="form-horizontal" enctype="multipart/form-data" >
                        @csrf
                        <div class="modal-body">

                            <div class="form-group row">
                                <label for="name" class="col-md-4 control-label">Choose file..</label>
                                <div class="col-md-8">
                                    <input type="file" class="form-control @error('imported_file') is-invalid @enderror" name="imported_file" value="{{old('imported_file')}}" required placeholder="name">
                                    @error('imported_file')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="btn-save">Import</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end create new permission form modal -->
    @endcan





@endsection
