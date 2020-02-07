@extends('layouts.individual')
@section('title','Position')
@section('content')


    <div class="card position">
        <div class="card-header">
            <div class="float-left">
                <h1 class="h4">Position</h1>
            </div>
            <div class="float-right">
                @can('position-create')
                    <a class="btn btn-primary" href="{{route('positions.create')}}" title="create"><i class="fa fa-plus"></i> Position</a>
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
                        <th scope="col">Organization</th>
                        <th scope="col">City</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">End Date</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($positions as $position)
                        <tr>
                            <td class="text-left">{{ $position->individual->full_name }}</td>
                            <td class="text-center">{{ $position->organization->name }}</td>
                            <td class="text-center">{{ $position->city->name }}</td>
                            <td class="text-center">{{$position->start_date}}</td>
                            <td class="text-center">{{$position->end_date}}</td>
                            <td class="text-center">
                                <div class="btn btn-group">
                                    @can('position-update')
                                        <a class="btn btn-primary btn-sm mr-2 " href="{{route('positions.edit',$position)}}" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @endcan
                                    @can('position-delete')
                                        <form class="form-delete" method="post" action="{{route('positions.destroy',$position)}}">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this Position?')" title="delete"><i class="fa fa-trash-alt"></i></button>
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
