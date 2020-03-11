@extends('layouts.location')
@section('title','List of Cities')
@section('content')

    <div class="card">
        <div class="card-header">
            <div class="float-left">
                <h4 class="header-title">List of Cities</h4>
            </div>
            <div class="float-right">
                @can('city-create')
                    <a class="btn btn-dark mr-4 " href="#import" data-toggle="modal"><i class="fa fa-upload"></i> Import</a>
                    <a class="btn btn-success" href="#newCity" data-toggle="modal"><i class="fa fa-plus"></i> New city</a>
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
                        <th scope="col">Country</th>
                        <th scope="col">Descriptions</th>
                        <th scope="col" >Actions</th>
                    </tr>
                    {{ csrf_field() }}
                    </thead>
                    <tbody>
                    @foreach ($cities as $city)
                        <tr>
                            <td class="text-left">{{$city->name}}</td>
                            <td class="text-center">{{$city->slug}}</td>
                            <td class="text-center">{{$city->country->name}}</td>
                            <td class="text-left">{{$city->desc}}</td>
                            <td class="text-center p-0">
                                <div class="btn btn-group">
                                    @can('city-update')
                                        <a class="btn btn-primary btn-sm mr-2" href="{{route('cities.edit',$city['id'])}}" title="Edit"><i class="fa fa-edit"></i></a>
                                    @endcan

                                    @can('city-delete')
                                        <form class="form-delete" method="post" action="{{route('cities.destroy',$city['id'])}}">
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

    @can('city-create')
        <!-- start create new city form modal -->
        <div class="modal fade" id="newCity" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New City</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{route('cities.store')}}" class="form-horizontal" role="form" id="cityForm" name="cityForm" autocomplete="off">
                        @csrf
                        <div class="modal-body">

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="col-form-label">City Name <span class="star">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" placeholder="Ex. Rwanda, Nairobi" required/>
                                    @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    @include('partials.countries.dropdown',['value'=>null])
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
                            <button type="submit" class="btn btn-success" id="btn-save">save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end create new city form modal -->

        <!-- start create new permission form modal -->
        <div class="modal fade" id="import" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import cities/regions</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{route('cities.import')}}" class="form-horizontal" enctype="multipart/form-data" >
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
                            <button type="submit" class="btn btn-success" id="btn-save">Import</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end create new permission form modal -->
    @endcan

@endsection
