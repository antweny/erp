@foreach ($countries as $country)
    <tr>
        <td class="text-left">{{$country->name}}</td>
        <td class="text-center">{{$country->slug}}</td>
        <td class="text-left">{{$country->desc}}</td>
        <td class="text-center p-0">
            <div class="btn btn-group">
                @if(checkPermission('country-update'))
                    <a class="btn btn-primary btn-sm mr-2" href="{{route('countries.edit',$country['id'])}}" title="Edit"><i class="fa fa-edit"></i></a>
                @endif
                @if(checkPermission('country-delete'))
                    <form class="form-delete" method="post" action="{{route('countries.destroy',$country['id'])}}">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fa fa-trash-alt"></i></button>
                    </form>
                @endif
            </div>
        </td>
    </tr>
@endforeach
