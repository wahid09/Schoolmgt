<thead>
	<tr>
		<th>SL</th>
		<th>Batch Name</th>
		<th>Student Capacity</th>
		<th>Status</th>
		<th style="width: 150px;">Action</th>
	</tr>
</thead>
<tbody>
	@foreach ($batches as $batche)
		<tr>
			<td>{{ $loop->index+1}}</td>
			<td>{{ $batche->name }}</td>
			<td>{{ $batche->student_capacity }}</td>
			<td>
				@if($batche->status == 1)
                <span class="badge bg-green">Active</span>
                @else
                <span class="badge bg-red">Inactive</span>
                @endif
			</td>
			<td>
				@if($batche->status == 1)
				<button onclick='unpublish("{{$batche->id}}", "{{$batche->class_name_id}}")' class="btn btn-sm btn-success" id="unpublished"><span class="fa fa-arrow-alt-circle-up"></span></button>
				@else
				<button onclick='publish("{{$batche->id}}", "{{$batche->class_name_id}}")' class="btn btn-sm btn-warning" id="published"><span class="fa fa-arrow-alt-circle-up"></span></button>
				@endif
                <!-- <a href="#" class="btn btn-sm btn-info"><span class="fa fa-edit"></span></a> -->
                <button class="btn btn-sm btn-primary" data-myname="{{$batche->name}}" data-batchid={{$batche->id}} data-classid={{$batche->class_name_id}} data-capacity={{$batche->student_capacity}} data-toggle="modal" data-target="#edit"><span class="fa fa-edit" title="Edit"></span></button>
                <!-- <a href="#" class="btn btn-sm btn-danger"><span class="fa fa-trash"></span></a> -->
                <button onclick='delItem("{{$batche->id}}", "{{$batche->class_name_id}}")' class="btn btn-sm btn-danger" id="detItem"><span class="fa fa-trash"></span></button>
			</td>
		</tr>
	@endforeach
</tbody>
<script type="text/javascript">
	function unpublish(batchId, ClassId) {
		var check = confirm('If you want to inactive this item, Please press ok..');
		if(check){
			$.get("{{ route('unpublishbyajax') }}", {batchId:batchId, ClassId:ClassId}, function(data){
                $("#batchList").html(data);
            });
		}
	}

	//Status publish 
	function publish(batchId, ClassId) {
		var check = confirm('If you want to inactive this item, Please press ok..');
		if(check){
			$.get("{{ route('publishbyajax') }}", {batchId:batchId, ClassId:ClassId}, function(data){
                $("#batchList").html(data);
            });
		}
	}

	// Batch Delete
	function delItem(batchId, ClassId) {
		var check = confirm('If you want to delete this item, Please press ok..');
		if(check){
			$.get("{{ route('batchdeletebyajax') }}", {batchId:batchId, ClassId:ClassId}, function(data){
                $("#batchList").html(data);
            });
		}
	}
</script>