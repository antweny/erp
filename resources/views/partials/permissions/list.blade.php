@foreach ($permissions as $permission)
    <tr>
        <td>{{$permission->name}}</td>
        <td  class="text-center">{{$permission->guard_name}}</td>
        <td  class="text-center">{{$permission->desc}}</td>
        <td class="text-center">
            <div class="btn-group">
                <a class="btn btn-primary btn-sm mr-2" href="{{route('permissions.edit',$permission)}}" title="Edit"><i class="fa fa-edit"></i> </a>
                <form class="form-delete" method="post" action="{{route('permissions.destroy',$permission)}}">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete {{$permission->name}} permission?')"><i class="fa fa-trash-alt"></i></button>
                </form>
            </div>
        </td>
    </tr>
@endforeach
