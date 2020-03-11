@foreach ($itemUnits as $itemUnit)
    <tr>
        <td class="text-left">{{$itemUnit->name}}</td>
        <td class="text-center">{{$itemUnit->desc}}</td>
        <td class="text-center">
            <div class="btn-group">
                @can('itemUnit-update')
                    <a class="btn btn-primary btn-sm mr-2" href="{{route('itemUnits.edit',$itemUnit)}}" title="Edit"><i class="fa fa-edit"></i></a>
                @endcan

                @can('itemUnit-delete')
                    <form class="form-delete" method="post" action="{{route('itemUnits.destroy',$itemUnit)}}">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete {{$itemUnit->name}} unit?')" title="Delete"><i class="fa fa-trash-alt"></i></button>
                    </form>
                @endcan

            </div>
        </td>
    </tr>
@endforeach
