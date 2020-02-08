@extends('layouts.location')
@section('title','Venues')
@section('content')

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-12">
                    <div class="float-left">
                        <h4 class="header-title">Venues</h4>
                    </div>
                    <div class="float-right">
                        @can('venue-import')
                            <a class="btn btn-secondary mr-4 " href="#import" data-toggle="modal"><i class="fa fa-plus"></i> Import</a>
                        @endcan
                        @can('venue-create')
                            <a class="btn btn-primary" href="{{route('venues.create')}}"><i class="fa fa-plus"></i> New venue</a>
                        @endcan
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
                        <th scope="col">Region</th>
                        <th scope="col">District</th>
                        <th scope="col">Type</th>
                        <th scope="col">Capacity</th>
                        <th scope="col">Contact Person</th>
                        <th scope="col">Person Number</th>
                        <th scope="col" >Actions</th>
                    </tr>
                    {{ csrf_field() }}
                    </thead>
                    <tbody>
                        @foreach ($venues as $venue)
                            <tr>
                                <td class="text-left">{{$venue->name}}</td>
                                <td class="text-center">{{$venue->city->name}}</td>
                                <td class="text-center">{{$venue->district->name}}</td>
                                <td class="text-center">{{$venue->type}}</td>
                                <td class="text-center">{{$venue->capacity}}</td>
                                <td class="text-center">{{$venue->contact_person}}</td>
                                <td class="text-center">{{$venue->contact_person_number}}</td>
                                <td class="text-center p-0">
                                    <div class="btn btn-group">

                                        @can('venue-update')
                                            <a class="btn btn-primary btn-sm mr-3" href="{{route('venues.edit',$venue)}}" title="Edit"><i class="fa fa-edit"></i></a>
                                        @endcan

                                        @can('venue-delete')
                                            <form class="form-delete" method="post" action="{{route('venues.destroy',$venue)}}">
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


    @can('venue-import')
        <!-- start create new permission form modal -->
        <div class="modal fade" id="import" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import venues</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{route('venues.import')}}" class="form-horizontal" enctype="multipart/form-data" >
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
