@extends('layouts.admin')
@section('title','Gender Series Participants')
@section('content')

    <div class="card event">
        <div class="card-header">
            <div class="float-left">
                <h1 class="h4">Gender Series Participants</h1>
            </div>
            <div class="float-right">
                @if(checkPermission('genderSeriesParticipant-create'))
                    <a class="btn btn-secondary mr-4 " href="#import" data-toggle="modal"><i class="fa fa-plus"></i> Import</a>
                    <a class="btn btn-primary" href="{{route('genderSeriesParticipants.create')}}" title="create"><i class="fa fa-plus"></i> GDSS Participant</a>
                @endif
            </div>
        </div>
        <div class="card-body">
            @include('alerts._flash')

            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm" id="table">
                    <thead class="text-uppercase text-center bg-blue">
                    <tr class="text-white">
                        <th scope="col">Participant Name</th>
                        <th scope="col">Topic</th>
                        <th scope="col">Sex</th>
                        <th scope="col">Age</th>
                        <th scope="col">Organization</th>
                        <th scope="col">Ward</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($genderParticipants as $genderParticipant)
                        <tr>
                            <td class="text-left">{{ $genderParticipant->individual->full_name }}</td>
                            <td class="text-left">{{ $genderParticipant->gender_series->topic }}</td>
                            <td class="text-center">{{ $genderParticipant->individual->sex }}</td>
                            <td class="text-center">{{ $genderParticipant->individual->age_group }}</td>
                            <td class="text-center">{{ $genderParticipant->organization->organization_name }}</td>
                            <td class="text-center">{{ $genderParticipant->ward->name }}</td>
                            <td class="text-center p-0">
                                <div class="btn btn-group">
                                    @if(checkPermission('genderSeriesParticipant-update'))
                                        <a class="btn btn-primary btn-sm mr-2" href="{{route('genderSeriesParticipants.edit',$genderParticipant->id)}}" title="view">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @endif
                                    @if(checkPermission('genderSeriesParticipant-delete'))
                                        <form class="form-delete" method="post" action="{{route('genderSeriesParticipants.destroy',$genderParticipant->id)}}">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete Participant?')" title="Delete"><i class="fa fa-trash-alt"></i></button>
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


    @if(checkPermission('genderSeriesParticipant-create'))
        <!-- start create new permission form modal -->
        <div class="modal fade" id="import" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import Gender Series Participants</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{route('genderSeriesParticipants.import')}}" class="form-horizontal" enctype="multipart/form-data" >
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
    @endif



@endsection
