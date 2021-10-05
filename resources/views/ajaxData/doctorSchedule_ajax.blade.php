@foreach($docSchedule as $row)
<tr id="{{ $row->id }}">
<td>{{ $row->firstname }} {{ $row->lastname }}</td>
<td>{{ $row->schedule_date }}</td>
<td>{{ $row->start_time }}</td>
<td>{{ $row->end_time }}</td>
<td>{{ $row->consulting_time }} Minute</td>
<td>
<button class="btn btn-info" data-id="{{ $row->id }}" id="doctorScheduleEdit"><i class="fa fa-edit text-white"></i></button>
<button class="btn btn-info" data-id="{{ $row->id }}" id="doctorScheduleDelete"><i class="fa fa-trash text-white"></i></button>
</td>
</tr>
@endforeach
<tr>
<td colspan="3" align="center">
{{ $docSchedule->links('pagination_data') }}
</td>
</tr>
