function edit(id)
{
	swal({
			title: "Warning",
			text: "Are you sure to modify this job type!",
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
		    window.location.href='job_inputs.php?input=job_type&edit='+id;
		} else {
		    swal("Cancelled", "Job type is not modified!", "error");
		}
	});
}

function add(id)
{
	window.location.href='job_inputs.php?input=job_type&add='+id;
}

function remove(id)
{
	swal({
			title: "Warning",
			text: "Are you sure to remove this job type!",
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
		    window.location.href='job_inputs.php?input=job_type&remove='+id;
		} else {
		    swal("Cancelled", "Job type is not removed!", "error");
		}
	});
}