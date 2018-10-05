function edit(id)
{
	swal({
			title: "Warning",
			text: "Are you sure to modify this color!",
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
		    window.location.href='job_inputs.php?input=colors&edit='+id;
		} else {
		    swal("Cancelled", "Color is not modified!", "error");
		}
	});
}

function add(id)
{
	window.location.href='job_inputs.php?input=colors&add='+id;
}

function remove(id)
{
	swal({
			title: "Warning",
			text: "Are you sure to remove this color!",
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
		    window.location.href='job_inputs.php?input=colors&remove='+id;
		} else {
		    swal("Cancelled", "Color is not removed!", "error");
		}
	});
}