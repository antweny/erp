@foreach ($itemRequests as $itemRequest)
    <tr>
        <td class="text-center">{{$itemRequest->created_at}}</td>
        <td class="text-center">{{$itemRequest->item->name}}</td>
        <td class="text-center">{{$itemRequest->required}}</td>
        <td class="text-center">{{$itemRequest->quantity}}</td>
        <td class="text-center">{!! $itemRequest->item_status!!}</td>
        <td class="text-center">{{$itemRequest->employee->full_name}}</td>
        <td class="text-center">{{$itemRequest->date_issued}}</td>
        <td class="text-center">
            <div class="btn-group">
                @can('itemRequest-update')
                    <a class="btn btn-primary btn-sm mr-2" href="{{route('itemRequests.edit',$itemRequest->id)}}" title="issue item"><i class="fa fa-upload"></i></a>
                @endcan
                @can('itemRequest-delete')
                    <form class="form-delete" method="post" action="{{route('itemRequests.destroy',$itemRequest->id)}}">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this?')" title="Delete"><i class="fa fa-trash-alt"></i></button>
                    </form>
                @endcan
            </div>
        </td>
    </tr>
@endforeach
