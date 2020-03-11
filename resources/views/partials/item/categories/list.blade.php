@foreach ($itemCategories as $itemCategory)
    <tr>
        <td class="text-left">{{$itemCategory->name}}</td>
        <td class="text-center">{{$itemCategory->desc}}</td>
        <td class="text-center">
            <div class="btn-group">
                @can('itemCategory-update')
                    <a class="btn btn-primary btn-sm mr-2" href="{{route('itemCategories.edit',$itemCategory)}}" title="Edit"><i class="fa fa-edit"></i></a>
                @endcan

                @can('itemCategory-delete')
                    <form class="form-delete" method="post" action="{{route('itemCategories.destroy',$itemCategory)}}">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete {{$itemCategory->name}} role?')" title="Delete"><i class="fa fa-trash-alt"></i></button>
                    </form>
                @endcan
            </div>
        </td>
    </tr>
@endforeach
