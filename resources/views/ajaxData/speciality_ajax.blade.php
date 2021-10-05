@foreach($getSpeciality as $row)
<tr id="{{ $row->id }}">
<td>{{ $row->id }}</td>
<td>{{ $row->name }}</td>
<td>
<button class="btn btn-info" data-id="{{ $row->id }}" id="specialityEdit"><i class="fa fa-edit text-white"></i></button>
<button class="btn btn-info" data-id="{{ $row->id }}" id="specialityDelete"><i class="fa fa-trash text-white"></i></button>
</td>
</tr>
@endforeach
<tr>
<td colspan="3" align="center">
{{ $getSpeciality->links('pagination_data') }}
</td>
</tr>
