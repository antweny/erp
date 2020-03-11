@extends('layouts.templates.library')
@section('title','Publications List')
@section('content')


    <div class="card">
        <div class="card-header">
            <div class="float-left">
                <h4 class="header-title">List of Publications</h4>
            </div>
            <div class="float-right">
                @can('publication-create')
                    <a class="btn btn-dark mr-2 " href="#import" data-toggle="modal"><i class="fa fa-upload"></i> Import</a>
                    <a class="btn btn-success" href="{{route('publications.create')}}"><i class="fa fa-plus"></i> New Publication</a>
                @endcan
            </div>
        </div>
        <div class="card-body">
            @include('alerts._flash')
            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm" id="table">
                    <thead class="text-uppercase text-center">
                    <tr class="text-white">
                        <th scope="col">Title</th>
                        <th scope="col">Author</th>
                        <th scope="col">Publisher</th>
                        <th scope="col" >Year</th>
                        <th scope="col" >Category</th>
                        <th scope="col" >Shelf</th>
                        <th scope="col" >Genre</th>
                        <th scope="col" >Class No.</th>
                        <th scope="col" >Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($publications as $publication)
                        <tr>
                            <td class="text-left">{{ $publication->title}}</td>
                            <td class="text-center">{{ $publication->author->name }}</td>
                            <td class="text-center">{{ $publication->publisher->name  }}</td>
                            <td class="text-center">{{ $publication->year  }}</td>
                            <td class="text-center">{{ $publication->publication_category->name  }}</td>
                            <td class="text-center">{{ $publication->shelf->name  }}</td>
                            <td class="text-center">{{ $publication->genre->name  }}</td>
                            <td class="text-center">{{ $publication->class_number  }}</td>
                            <td class="text-center p-0">
                                <div class="btn btn-group">

                                    @can('publication-update')
                                        <a class="btn btn-primary btn-sm mr-2 " href="{{route('publications.edit',$publication->id)}}" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @endcan

                                    @can('publication-delete')
                                        <form class="form-delete" method="post" action="{{route('publications.destroy',$publication->id)}}">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete {{$publication->name}} role?')" title="Delete"><i class="fa fa-trash-alt"></i></button>
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

    @can('publication-create')
        <!-- start create new permission form modal -->
        <div class="modal fade" id="import" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import Publications</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{route('publications.import')}}" class="form-horizontal" enctype="multipart/form-data" >
                        @csrf
                        <div class="modal-body">

                            <div class="form-group row">
                                <label for="name" class="col-md-4 control-label">Choose file..</label>
                                <div class="col-md-8">
                                    <input type="file" class="form-control @error('imported_file') is-invalid @enderror" name="imported_file" value="{{old('imported_file')}}" required placeholder="name">
                                    @error('imported_file')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success" id="btn-save">Import</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end create new permission form modal -->
    @endcan

@endsection
