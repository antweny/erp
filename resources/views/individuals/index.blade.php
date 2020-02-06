@extends('layouts.individual')
@section('title','Individuals')
@section('content')

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-12">
                    <div class="float-left">
                        <h4 class="header-title">Individuals</h4>
                    </div>
                    <div class="float-right">
                        @can('individual-import')
                            <a class="btn btn-secondary mr-4 " href="#import" data-toggle="modal"><i class="fa fa-plus"></i> Import</a>
                        @endcan
                        @can('individual-create')
                            <a class="btn btn-primary" href="{{route('individuals.create')}}"><i class="fa fa-plus"></i> New individual</a>
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
                        <th scope="col">Full Name</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Age Group</th>
                        <th scope="col">District</th>
                        <th scope="col">Occupation</th>
                        <th scope="col">Education Level</th>
                        <th scope="col">Mobile</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($individuals as $individual)
                            <tr>
                                <td class="text-left">{{ $individual->full_name }}</td>
                                <td class="text-center">{{ $individual->sex }}</td>
                                <td class="text-center">{{$individual->age_group}}</td>
                                <td class="text-center">{{$individual->district->name}}</td>
                                <td class="text-left">{{$individual->occupation}}</td>
                                <td class="text-center">{{$individual->education_level->name}}</td>
                                <td class="text-center">{{$individual->mobile}}</td>
                                <td class="text-center">
                                    <div class="btn btn-group">
                                        
                                            <a class="btn btn-secondary btn-sm mr-2" href="{{route('individuals.show',$individual)}}" title="View">
                                                <i class="fa fa-info-circle"></i>
                                            </a>

                                            <a class="btn btn-primary btn-sm mr-2" href="{{route('individuals.edit',$individual)}}" title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        
                                            @can('individual-delete')
                                                <form class="form-delete" method="post" action="{{route('individuals.destroy',$individual)}}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this individual {{$individual->full_name}}?')" title="Delete"><i class="fa fa-trash-alt"></i></button>
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

    @can('district-import')
        <!-- start create new permission form modal -->
        <div class="modal fade" id="import" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import individual</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{route('individuals.import')}}" class="form-horizontal" enctype="multipart/form-data" >
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