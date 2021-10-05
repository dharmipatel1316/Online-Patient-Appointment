@foreach($getDoctor as $row)
<tr id="{{ $row->id }}">
    <td><img src="{{ asset('resources/images/doctors').'/'.$row->doctor_image }}" alt="{{ $row->firstname }}" width="50" height="50"></td>
    <td>{{ $row->firstname }}</td>
    <td>{{ $row->lastname }}</td>
    <td>{{ $row->email }}</td>
    @if( $row->status === 'active')
    <td>
        <button class="btn btn-success" data-id="{{ $row->id }}" data-status="{{$row->status}}" id="doctorStatus" >{{ $row->status }}</button>
        <input type="hidden" id="status" value="{{ $row->status }}" />
    </td>
    @else
    <td>
        <button class="btn btn-danger" data-id="{{ $row->id }}" data-status="{{$row->status.$row->id}}" id="doctorStatus">{{ $row->status }}</button>
        <input type="hidden" id="status" value="{{ $row->status }}" />
    </td>
    @endif
    <td>
        <button class="btn btn-info" data-id="{{ $row->id }}" id="doctorEdit"><i class="fa fa-edit text-white"></i></button>
        <button class="btn btn-info" data-id="{{ $row->id }}" id="doctorDelete"><i class="fa fa-trash text-white"></i></button>
        <button class="btn btn-info" data-id="{{ $row->id }}" id="doctorView"><i class="fa fa-eye text-white"></i></button>
    </td>
</tr>
@endforeach
<tr>
    <td colspan="4" align="center">
        {{ $getDoctor->links('pagination_data') }}
    </td>
</tr>