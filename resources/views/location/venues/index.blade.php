@extends('layouts.admin')
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
                        @if(checkPermission('venue-create'))
                            <a class="btn btn-primary" href="{{route('venues.create')}}"><i class="fa fa-plus"></i> New venue</a>
                        @endif
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

                                        @if(checkPermission('venue-update'))
                                            <a class="btn btn-primary btn-sm mr-3" href="{{route('venues.edit',$venue->id)}}" title="Edit"><i class="fa fa-edit"></i></a>
                                        @endif

                                        @if(checkPermission('venue-delete'))
                                            <form class="form-delete" method="post" action="{{route('venues.destroy',$venue->id)}}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fa fa-trash-alt"></i></button>
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

@endsection
