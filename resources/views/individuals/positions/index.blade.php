@extends('layouts.templates.individuals')
@section('title','Individual Positions')
@section('content')

    <div class="card position">
        <div class="card-header">
            <div class="float-left">
                <h5>Individual Positions</h5>
            </div>
            <div class="float-right">
                @can('position-create')
                    <a class="btn btn-dark mr-2 " href="#import" data-toggle="modal"><i class="fa fa-upload"></i> Import</a>
                    <a class="btn btn-success" href="{{route('positions.create')}}" title="create"><i class="fa fa-plus"></i> New Position</a>
                @endcan
            </div>
        </div>
        <div class="card-body">
            @include('alerts._flash')
            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm" id="table">
                    <thead class="text-uppercase text-center bg-blue">
                    <tr class="text-white">
                        <th scope="col">Fullname</th>
                        <th scope="col">Title</th>
                        <th scope="col">Organization</th>
                        <th scope="col">JOIN DATE</th>
                        <th scope="col">End Date</th>
                        <th scope="col">City</th>
                        <th scope="col">District</th>
                        <th scope="col">Ward</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($positions as $position)
                        <tr>
                            <td class="text-left">{{ $position->individual->full_name }}</td>
                            <td class="text-center">{{ $position->title->name }}</td>
                            <td class="text-center">{{ $position->organization->name }}</td>
                            <td class="text-center">{!! $position->doj !!}</td>
                            <td class="text-center">{!! $position->status !!}</td>
                            <td class="text-center">{{ $position->city->name }}</td>
                            <td class="text-center">{{ $position->district->name }}</td>
                            <td class="text-center">{{ $position->ward->name }}</td>
                            <td class="text-center p-0">
                                <div class="btn btn-group">
                                    @if(checkPermission('position-update'))
                                        <a class="btn btn-primary btn-sm mr-2 " href="{{route('positions.edit',$position->id)}}" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @endif
                                    @if(checkPermission('position-delete'))
                                        <form class="form-delete" method="post" action="{{route('positions.destroy',$position->id)}}">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this Position?')" title="delete"><i class="fa fa-trash-alt"></i></button>
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

    @can('position-create')
        <!-- start create new permission form modal -->
        <div class="modal fade" id="import" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import Positions</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{route('positions.import')}}" class="form-horizontal" enctype="multipart/form-data" >
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
