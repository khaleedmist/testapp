@if(!empty($allPersons))
	<div class="datapagination" style="float:right">
	{!! $allPersons->links() !!}
	</div>
	<div style="float:right">
	{{ $totalPerson }} people in the list &nbsp;&nbsp;
	</div>
@endif
<table class="table table-bordered table-hover table-striped">

<thead>
	<tr class="table-success">
		<th scope="col">ID</th>
		<th scope="col">Email Address</th>
		<th scope="col">Name</th>
		<th scope="col">Location</th>
		<th scope="col">DOB</th>
		<th scope="col">Phone</th>
		<th scope="col">IP Address</th>
	</tr>
</thead>
<tbody>
@if(!empty($allPersons))
@foreach($allPersons as $data)
<tr>
	<th>{{ $data->ID }}</th>
	<td>{{ $data->EmailAddress }}</td>
	<td>{{ $data->Name }}</td>
	<td>{{ $data->Country }}</td>
	<td>{{ $data->BirthDay }}</td>
	<td>{{ $data->Phone }}</td>
	<td>{{ $data->IP }}</td>
</tr>
@endforeach
@else

	<tr>
		<td colspan="7">No data found.</td>
	</tr>

@endif
</tbody>
</table>

@if(!empty($allPersons))
	<div class="datapagination" style="float:right">
	{!! $allPersons->links() !!}
	</div>
	<div style="float:right">
	{{ $totalPerson }} people in the list &nbsp;&nbsp;
	</div>
@endif