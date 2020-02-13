@extends('layouts.organization')
@section('title','Sectors')
@section('content')

    <div class="card">
        <div class="card-header">
            <div class="float-left">
                <h4 class="header-title">Sectors</h4>
            </div>
            <div class="float-right">
                @if(checkPermission('sector-create'))
                    <a class="btn btn-primary" href="#newSector" data-toggle="modal"><i class="fa fa-plus"></i> New sector</a>
                @endif
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
                        @foreach ($sectors as $sector)
                            <tr>
                                <td class="text-left">{{$sector->name}}</td>
                                <td class="text-center">{{$sector->slug}}</td>
                                <td class="text-left">{{$sector->desc}}</td>
                                <td class="text-center p-0">
                                    <div class="btn btn-group">

                                        @if(checkPermission('sector-update'))
                                            <a class="btn btn-primary btn-sm mr-2" href="{{route('sectors.edit',$sector->id)}}" title="Edit"><i class="fa fa-edit"></i></a>
                                        @endif

                                        @if(checkPermission('sector-delete'))
                                            <form class="form-delete" method="post" action="{{route('sectors.destroy',$sector->id)}}">
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

    @if(checkPermission('sector-create'))
        <!-- start create new sector form modal -->
        <div class="modal fade" id="newSector" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create new sector</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{route('sectors.store')}}" class="form-horizontal" role="form" id="sectorForm" name="sectorForm" autocomplete="off" >
                        @csrf
                        <div class="modal-body">

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="col-form-label">Sector Name <span class="star">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }} " value="{{old('name')}}" placeholder="Ex. Health, Education" required/>
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
        <!-- end create new sector form modal -->
    @endif

@endsection
