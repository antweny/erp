@extends('layouts.templates.support')
@section('title','Ticket List')
@section('content')

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-12">
                    <div class="float-left">
                        <h4 class="header-title">Tickets List</h4>
                    </div>
                    <div class="float-right">
                        @can('ticket-create')
                            <a class="btn btn-success" href="{{route('tickets.create')}}"><i class="fa fa-plus"></i> Create Ticket</a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            @include('alerts._flash')

            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm" id="table">
                    <thead class="text-uppercase text-center">
                    <tr class="text-white">
                        <th scope="col">Created at</th>
                        <th scope="col">Submitted by</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Category</th>
                        <th scope="col">Priority</th>
                        <th scope="col">Status</th>
                        <th scope="col" >Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($tickets as $ticket)
                        <tr>
                            <td class="text-center">{{$ticket->created_at}}</td>
                            <td class="text-left">{{$ticket->employee->full_name}}</td>
                            <td class="text-left">{{$ticket->title}}</td>
                            <td class="text-left">{{$ticket->desc}}</td>
                            <td class="text-center">{{$ticket->ticket_category->name}}</td>
                            <td class="text-center">{{$ticket->priority}}</td>
                            <td class="text-center">{{$ticket->status}}</td>
                            <td class="text-center p-0">
                                <div class="btn btn-group">
                                    @if(checkPermission('ticket-update'))
                                        <a class="btn btn-primary btn-sm mr-2" href="{{route('tickets.edit',$ticket['id'])}}" title="Edit"><i class="fa fa-edit"></i></a>
                                    @endif
                                    @if(checkPermission('ticket-delete'))
                                        <form class="form-delete" method="post" action="{{route('tickets.destroy',$ticket['id'])}}">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete Confirmation?')"><i class="fa fa-trash-alt"></i></button>
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

    @can('ticketCategory-create')
        <!-- start create new ticketCategory form modal -->
        <div class="modal fade" id="newForm" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Ticket Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{route('ticketCategories.store')}}" class="form-horizontal" role="form" id="ticketCategoryForm" name="ticketCategoryForm" autocomplete="off" >
                        @csrf
                        <div class="modal-body">

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="col-form-label">Ticket Category Name <span class="star">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" placeholder="Ex. Contract" required/>
                                    @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label class="col-form-label">Descriptions</label>
                                    <textarea name="desc" id="desc" class="form-control @error('desc') is-invalid @enderror" rows="5">{{old('desc')}}</textarea>
                                    @error('desc')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success" id="btn-save">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end create new job Type form modal -->
    @endcan

@endsection
