@extends('layouts.templates.event')
@section('title','Gender Series Topics')
@section('content')

    <div class="card gender">
        <div class="card-header">
            <div class="float-left">
                <h5>Gender Series Topics (GDSS)</h5>
            </div>
            <div class="float-right">
                @can('genderSeries-create')
                    <a class="btn btn-success" href="{{route('genderSeries.create')}}" title="create"><i class="fa fa-plus"></i> New Topic</a>
                @endcan
            </div>
        </div>
        <div class="card-body">
            @include('alerts._flash')
            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm" id="table">
                    <thead class="text-uppercase text-center">
                    <tr class="text-white">
                        <th scope="col">Topic</th>
                        <th scope="col">Facilitators</th>
                        <th scope="col">Presenter</th>
                        <th scope="col">Date</th>
                        <th scope="col">Participants</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($genders as $gender)
                        <tr>
                            <td class="text-left">{{ $gender->topic }}</td>
                            <td class="text-center">{{ $gender->employee->full_name }}</td>
                            <td class="text-center">{{ $gender->individual->full_name }}</td>
                            <td class="text-center">{{ get_day_month_and_year($gender->date) }}</td>
                            <td class="text-center">
                                <a href="{{route('genderSeriesParticipants.show',$gender->id)}}" title="View Participants">
                                    {{ $gender->participants_count }}
                                </a>
                            </td>
                            <td class="text-center p-0">
                                <div class="btn btn-group">
                                    <a class="btn btn-warning text-white btn-sm mr-2 " href="{{route('genderSeries.participants',$gender->id)}}" title="Add Participant">
                                        <i class="fa fa-user-plus"></i>
                                    </a>
                                    @can('genderSeries-update')
                                        <a class="btn btn-primary btn-sm mr-2 " href="{{route('genderSeries.edit',$gender->id)}}" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @endcan
                                    @can('genderSeries-delete')
                                        <form class="form-delete" method="post" action="{{route('genderSeries.destroy',$gender->id)}}">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete {{$gender->topic}} topic?')" title="Delete"><i class="fa fa-trash-alt"></i></button>
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
