@extends('layouts.event')
@section('title','Event Categories')
@section('content')

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-12">
                    <div class="float-left">
                        <h4 class="header-title">Event Categories</h4>
                    </div>
                    <div class="float-right">
                        @can('eventCategory-create')
                            <a class="btn btn-primary" href="#newEventCategory" data-toggle="modal"><i class="fa fa-plus"></i> New Event Category </a>
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
                        <th scope="col">Slug</th>
                        <th scope="col">Descriptions</th>
                        <th scope="col" >Actions</th>
                    </tr>
                    {{ csrf_field() }}
                    </thead>
                    <tbody>
                        @foreach ($eventCategories as $eventCategory)
                            <tr>
                                <td class="text-left">{{$eventCategory->name}}</td>
                                <td class="text-center">{{$eventCategory->slug}}</td>
                                <td class="text-left">{{$eventCategory->desc}}</td>
                                <td class="text-center p-0">
                                    <div class="btn btn-group">
                                        @can('eventCategory-update')
                                            <a class="btn btn-primary btn-sm mr-2" href="{{route('eventCategories.edit',$eventCategory)}}" title="Edit"><i class="fa fa-edit"></i></a>
                                        @endcan

                                        @can('eventCategory-delete')
                                            <form class="form-delete" method="post" action="{{route('eventCategories.destroy',$eventCategory)}}">
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

    @can('eventCategory-create')
        <!-- start create new eventCategory form modal -->
        <div class="modal fade" id="newEventCategory" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Event Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{route('eventCategories.store')}}" class="form-horizontal" role="form" id="eventCategoryForm" name="eventCategoryForm" >
                        @csrf
                        <div class="modal-body">

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="col-form-label">Event Category Name <span class="star">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }} " value="{{old('name')}}" placeholder="Ex. Exhibition, Festival" required/>
                                    @if ($errors->has('name'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('name') }}</strong></span>@endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label class="col-form-label">Descriptions</label>
                                    <textarea name="desc" id="desc" class="form-control{{ $errors->has('desc') ? ' is-invalid' : '' }}" rows="5">{{old('desc')}}</textarea>
                                    @if ($errors->has('desc'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('desc') }}</strong></span>@endif
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="btn-save">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end create new eventCategory form modal -->
    @endcan

@endsection
