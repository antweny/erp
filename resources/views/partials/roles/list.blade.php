@foreach ($roles as $role)
    <tr>
        <td class="text-left">{{$role->name}}</td>
        <td class="text-center">{{$role->guard_name}}</td>
        <td class="text-center">{!! str_replace(array('[', ']', '"'),' ', $role->permissions()->pluck('name')) !!}</td>{{-- Retrieve array of permissions associated to a role and convert to string --}}
        <td class="text-center p-0">
            <div class="btn btn-group">
                <a class="btn btn-primary btn-sm mr-2" href="{{route('roles.edit',$role)}}" title="Edit"><i class="fa fa-edit"></i></a>
                <form class="form-delete" method="post" action="{{route('roles.destroy',$role)}}">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete {{$role->name}} role?')" title="Delete"><i class="fa fa-trash-alt"></i></button>
                </form>

            </div>
        </td>
    </tr>
@endforeach
