@extends('layouts.event')
@section('title','Gender Series Topics')
@section('content')

    <div class="card gender">
        <div class="card-header">
            <div class="float-left">
                <h1 class="h4">Gender Series Topics</h1>
            </div>
            <div class="float-right">
                @can('genderSeries-create')
                    <a class="btn btn-primary" href="{{route('genderSeries.create')}}" title="create"><i class="fa fa-plus"></i> New Topic</a>
                @endcan
            </div>
        </div>
        <div class="card-body">
            @include('alerts._flash')
            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm" id="table">
                    <thead class="text-uppercase text-center bg-blue">
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
                            <td class="text-center">{{ $gender->gender_participant_count }}</td>
                            <td class="text-center p-0">
                                <div class="btn btn-group">
                                    @can('participant-create')

                                    @endcan
                                    @can('genderSeries-update')
                                        <a class="btn btn-primary btn-sm mr-2 " href="{{route('genderSeries.edit',$gender)}}" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @endcan
                                    @can('genderSeries-delete')
                                        <form class="form-delete" method="post" action="{{route('genderSeries.destroy',$gender)}}">
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
