function edit(id)
{
	swal({
			title: "Warning",
			text: "Are you sure to modify this status!",
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
		    window.location.href='job_inputs.php?input=status&edit='+id;
		} else {
		    swal("Cancelled", "Status is not modified!", "error");
		}
	});
}

function add(id)
{
	window.location.href='job_inputs.php?input=status&add='+id;
}

function remove(id)
{
	swal({
			title: "Warning",
			text: "Are you sure to remove this status!",
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
		    window.location.href='job_inputs.php?input=status&remove='+id;
		} else {
		    swal("Cancelled", "Status is not removed!", "error");
		}
	});
}