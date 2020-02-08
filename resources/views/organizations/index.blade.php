@extends('layouts.organization')

@section('title','Organizations')

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-12">
                    <div class="float-left">
                        <h4 class="header-title">Organizations</h4>
                    </div>
                    <div class="float-right">
                        @can('organization-import')
                            <a class="btn btn-secondary mr-4 " href="#import" data-toggle="modal"><i class="fa fa-plus"></i> Import</a>
                        @endcan
                        @can('organization-create')
                            <a class="btn btn-primary" href="{{route('organizations.create')}}"><i class="fa fa-plus"></i> New organization</a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
        @include('alerts._flash')
            <div class="table-responsive">
                <table class="table text-center table-hover table-sm" id="table">
                    <thead class="text-uppercase text-center bg-blue">
                        <tr class="text-white">
                            <th scope="col" width="200">Name</th>
                            <th scope="col">City/Region</th>
                            <th scope="col">District</th>
                            <th scope="col">Ward</th>
                            <th scope="col">Operation Level</th>
                            <th scope="col">Contact Person</th>
                            <th scope="col">Person Number</th>
                            <th scope="col" >Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($organizations as $organization)
                            <tr>
                                <td class="text-left">{{$organization->organization_name}}</td>
                                <td class="text-left">{{$organization->city->name}}</td>
                                <td class="text-center">{{$organization->district->name}}</td>
                                <td class="text-center">{{$organization->ward->name}}</td>
                                <td class="text-center">{{$organization->op_level}}</td>
                                <td class="text-center">{{$organization->contact_person}}</td>
                                <td class="text-center">{{$organization->contact_person_number}}</td>

                                <th class="text-center p-0" >
                                    <div class=" btn btn-group">
                                            <a class="btn btn-info text-white btn-sm mr-2" href="{{route('organizations.show',$organization)}}" title="View"><i class="fa fa-info-circle"></i></a>
                                            <a class="btn btn-primary btn-sm mr-2" href="{{route('organizations.edit',$organization)}}" title="Edit"><i class="fa fa-edit"></i></a>
                                            <form class="form-delete" method="post" action="{{route('organizations.destroy',$organization)}}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this organization {{$organization->organization_name}}?')" title="Delete"><i class="fa fa-trash-alt"></i></button>
                                            </form>
                                    </div>

                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    @can('organization-import')
        <!-- start create new permission form modal -->
        <div class="modal fade" id="import" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import organizations</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{route('organizations.import')}}" class="form-horizontal" enctype="multipart/form-data" >
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
