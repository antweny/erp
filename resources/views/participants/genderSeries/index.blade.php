@extends('layouts.event')
@section('title','Gender Series Participants')
@section('content')

    <div class="card event">
        <div class="card-header">
            <div class="float-left">
                <h1 class="h4">Gender Series Participants</h1>
            </div>
            <div class="float-right">
                @can('genderSeriesParticipant-create')
                    <a class="btn btn-primary" href="{{route('genderSeriesParticipants.create')}}" title="create"><i class="fa fa-plus"></i> GDSS Participant</a>
                @endcan
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
                                    @can('genderSeriesParticipant-update')
                                        <a class="btn btn-primary btn-sm mr-2" href="{{route('genderSeriesParticipants.edit',$genderParticipant)}}" title="view">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @endcan
                                    @can('genderSeriesParticipant-delete')
                                        <form class="form-delete" method="post" action="{{route('genderSeriesParticipants.destroy',$genderParticipant)}}">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete Participant?')" title="Delete"><i class="fa fa-trash-alt"></i></button>
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

@endsection
