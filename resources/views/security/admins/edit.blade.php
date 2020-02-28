@extends('layouts.templates.security')
@section('title','Update administrator')
@section('content')

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h4 class="header-title">Edit administrator</h4>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-warning text-white" href="{{route('admin.index')}}" ><i class="fa fa-list"></i> view list</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    {{ Form::model($admin, array('route' => array('admin.update',$admin), 'method' => 'PUT')) }}
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="name" class="col-form-label">Fullname</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$admin->name}}" required placeholder="Fullname">
                                @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="email" class="col-form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$admin->email}}" readonly >
                                @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            @include('partials.roles.dropdown')
                        </div>

                        <div class="form-group row justify-content-center">
                            <div class="col-md-12">
                                <div class="float-left">
                                   <a href="{{route('admin.index')}}" class="btn btn-dark ">cancel</a>
                                </div>
                                <div class="float-right">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </div>
                        </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection
