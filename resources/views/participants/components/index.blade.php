<table class="table table-striped table-hover table-sm" id="table">
    <thead class="text-uppercase text-center bg-blue">
    <tr class="text-white">
        <th scope="col">Participant Name</th>
        <th scope="col">Sex</th>
        <th scope="col">Age</th>
        <th scope="col">Event</th>
        <th scope="col">Organization</th>
        <th scope="col">Group</th>
        <th scope="col">Role</th>
        <th scope="col">Level</th>
        <th scope="col">Date</th>
        <th scope="col">Ward</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($participants as $participant)
        <tr>
            <td class="text-left">{{ $participant['individual'] }}</td>
            <td class="text-center">{{ $participant['sex'] }}</td>
            <td class="text-center">{{ $participant['age_group'] }}</td>
            <td class="text-center">{{ $participant['event'] }}</td>
            <td class="text-center">{{ $participant['organization'] }}</td>
            <td class="text-center">{{ $participant['group'] }}</td>
            <td class="text-center">{{ $participant['role'] }}</td>
            <td class="text-center">{{ $participant['level']}}</td>
            <td class="text-center">{{ $participant['date']}}</td>
            <td class="text-center">{{ $participant['ward'] }}</td>
            <td class="text-center p-0">
                <div class="btn btn-group">
                    @can('participant-update')
                        <a class="btn btn-primary btn-sm mr-2" href="{{route('participants.edit',$participant['id'])}}" title="view">
                            <i class="fa fa-edit"></i>
                        </a>
                    @endcan
                    @can('participant-delete')
                        <form class="form-delete" method="post" action="{{route('participants.destroy',$participant['id'])}}">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete Participant?')" title="Delete"><i class="fa fa-trash-alt"></i></button>
                        </form>
                    @endcan
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
