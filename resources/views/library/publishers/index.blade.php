@extends('layouts.templates.library')
@section('title','List of Publishers')
@section('content')

    <div class="card">
        <div class="card-header">
            <div class="float-left">
                <h4 class="header-title">List of Publishers</h4>
            </div>
            <div class="float-right">
                @can('publisher-create')
                    <a class="btn btn-success" href="#newPublisher" data-toggle="modal"><i class="fa fa-plus"></i> New Publisher</a>
                @endcan
            </div>
        </div>
        <div class="card-body">
            @include('alerts._flash')

            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm" id="table">
                    <thead class="text-uppercase text-center">
                    <tr class="text-white">
                        <th scope="col">Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Mobile</th>
                        <th scope="col" >Email</th>
                        <th scope="col" >Website</th>
                        <th scope="col" >Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($publishers as $publisher)
                        <tr>
                            <td class="text-left">{{$publisher->name}}</td>
                            <td class="text-center">{{$publisher->address}}</td>
                            <td class="text-center">{{$publisher->mobile}}</td>
                            <td class="text-center">{{$publisher->email}}</td>
                            <td class="text-center">{{$publisher->website}}</td>
                            <td class="text-center p-0">
                                <div class="btn btn-group">
                                    @if(checkPermission('publisher-update'))
                                        <a class="btn btn-primary btn-sm mr-2" href="{{route('publishers.edit',$publisher['id'])}}" title="Edit"><i class="fa fa-edit"></i></a>
                                    @endif
                                    @if(checkPermission('publisher-delete'))
                                        <form class="form-delete" method="post" action="{{route('publishers.destroy',$publisher['id'])}}">
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

    @can('publisher-create')
        <!-- start create new publisher form modal -->
        <div class="modal fade" id="newPublisher" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New publisher</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{route('publishers.store')}}" class="form-horizontal" role="form" id="publisherForm" name="publisherForm" autocomplete="off" >
                        @csrf
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="col-form-label">Publisher Name <span class="star">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" required/>
                                    @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="col-form-label">Mobile </label>
                                    <input type="text" name="mobile" id="mobile" class="form-control @error('mobile') is-invalid @enderror" value="{{old('mobile')}}" />
                                    @error('mobile')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="col-form-label">Address </label>
                                    <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="2">{{old('address')}}</textarea>
                                    @error('address')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="col-form-label">Email</label>
                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}"/>
                                    @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="col-form-label">Website</label>
                                    <input type="website" name="website" id="website" class="form-control @error('website') is-invalid @enderror" value="{{old('website')}}"/>
                                    @error('website')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success" id="btn-save">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end create new publisher form modal -->
    @endcan

@endsection
