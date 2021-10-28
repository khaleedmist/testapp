@if(!empty($allPersons->data))
	<div class="datapagination" style="float:right">
		<nav>
		   <ul class="pagination">
				  <li class="page-item disabled" aria-disabled="true" aria-label="« Previous">
					 <span class="page-link" aria-hidden="true">‹</span>
				  </li>
				  <?php
					foreach($allPersons->links as $links)
					{
				  ?>
						<li class="page-item"><a class="page-link" href="<?=$links->url?>"><?=$links->label?></a></li>
				  <?php
					}
				  ?>
				  <!-- <li class="page-item active" aria-current="page"><span class="page-link">1</span></li>
				  <li class="page-item"><a class="page-link" href="http://127.0.0.1:8000/fetch_data?page=2">2</a></li>
				  <li class="page-item"><a class="page-link" href="http://127.0.0.1:8000/fetch_data?page=3">3</a></li>
				  <li class="page-item"><a class="page-link" href="http://127.0.0.1:8000/fetch_data?page=4">4</a></li>
				  <li class="page-item">
					 <a class="page-link" href="http://127.0.0.1:8000/fetch_data?page=2" rel="next" aria-label="Next »">›</a>
				  </li> -->
		   </ul>
		</nav>
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
@if(!empty($allPersons->data))
@foreach($allPersons->data as $data)
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

@if(!empty($allPersons->data))
	<div class="datapagination" style="float:right">
		<nav>
		   <ul class="pagination">
				  <li class="page-item disabled" aria-disabled="true" aria-label="« Previous">
					 <span class="page-link" aria-hidden="true">‹</span>
				  </li>
				  <?php
					foreach($allPersons->links as $links)
					{
				  ?>
						<li class="page-item"><a class="page-link" href="<?=$links->url?>"><?=$links->label?></a></li>
				  <?php
					}
				  ?>
				  <!-- <li class="page-item active" aria-current="page"><span class="page-link">1</span></li>
				  <li class="page-item"><a class="page-link" href="http://127.0.0.1:8000/fetch_data?page=2">2</a></li>
				  <li class="page-item"><a class="page-link" href="http://127.0.0.1:8000/fetch_data?page=3">3</a></li>
				  <li class="page-item"><a class="page-link" href="http://127.0.0.1:8000/fetch_data?page=4">4</a></li>
				  <li class="page-item">
					 <a class="page-link" href="http://127.0.0.1:8000/fetch_data?page=2" rel="next" aria-label="Next »">›</a>
				  </li> -->
		   </ul>
		</nav>	
	</div>
	<div style="float:right">
	{{ $totalPerson }} people in the list &nbsp;&nbsp;
	</div>
@endif