@extends('layouts.templates.individuals')
@section('title','Individual Groups')
@section('content')

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-12">
                    <div class="float-left">
                        <h4 class="header-group">Individual Groups</h4>
                    </div>
                    <div class="float-right">
                        @can('group-create')
                            <a class="btn btn-success" href="#newGroup" data-toggle="modal"><i class="fa fa-plus"></i> New group</a>
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
                        <th scope="col">Slug</th>
                        <th scope="col">Descriptions</th>
                        <th scope="col" >Actions</th>
                    </tr>

                    </thead>
                    <tbody>
                        @foreach ($groups as $group)
                            <tr>
                                <td class="text-left">{{$group->name}}</td>
                                <td class="text-center">{{$group->slug}}</td>
                                <td class="text-left">{{$group->desc}}</td>
                                <td class="text-center p-0">
                                    <div class="btn btn-group">

                                        @can('group-update')
                                            <a class="btn btn-primary btn-sm mr-2" href="{{route('groups.edit',$group->id)}}" title="Edit"><i class="fa fa-edit"></i></a>
                                        @endcan

                                        @can('group-delete')
                                            <form class="form-delete" method="post" action="{{route('groups.destroy',$group->id)}}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete group {{$group->name}}')"><i class="fa fa-trash-alt"></i></button>
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

    @can('group-create')
        <!-- start create new group form modal -->
        <div class="modal fade" id="newGroup" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-group" id="exampleModalLabel">Create new group</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{route('groups.store')}}" class="form-horizontal" role="form" id="groupForm" name="groupForm" autocomplete="off">
                        @csrf
                        <div class="modal-body">

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="col-form-label">Group Name <span class="star">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }} " value="{{old('name')}}" placeholder="Ex. Journalist, Editor, Rapporteur" required/>
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
                            <button type="submit" class="btn btn-primary" id="btn-save">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end create new group form modal -->
    @endcan

@endsection
