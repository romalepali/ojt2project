function edit(id)
{
	swal({
			title: "Warning",
			text: "Are you sure to modify this job kind!",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-danger",
			confirmButtonText: "Yes",
			cancelButtonText: "No",
			closeOnConfirm: false,
  			closeOnCancel: false
		},
		function(isConfirm){
		if (isConfirm) {
		    window.location.href='job_inputs.php?input=job_kind&edit='+id;
		} else {
		    swal("Cancelled", "Job kind is not modified!", "error");
		}
	});
}

function add(id)
{
	window.location.href='job_inputs.php?input=job_kind&add='+id;
}

function remove(id)
{
	swal({
			title: "Warning",
			text: "Are you sure to remove this job kind!",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-danger",
			confirmButtonText: "Yes",
			cancelButtonText: "No",
			closeOnConfirm: false,
  			closeOnCancel: false
		},
		function(isConfirm){
		if (isConfirm) {
		    window.location.href='job_inputs.php?input=job_kind&remove='+id;
		} else {
		    swal("Cancelled", "Job kind is not removed!", "error");
		}
	});
}