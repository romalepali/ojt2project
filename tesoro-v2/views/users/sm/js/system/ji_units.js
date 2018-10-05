function edit(id)
{
	swal({
			title: "Warning",
			text: "Are you sure to modify this unit!",
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
		    window.location.href='job_inputs.php?input=units&edit='+id;
		} else {
		    swal("Cancelled", "Unit is not modified!", "error");
		}
	});
}

function add(id)
{
	window.location.href='job_inputs.php?input=units&add='+id;
}

function remove(id)
{
	swal({
			title: "Warning",
			text: "Are you sure to remove this units!",
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
		    window.location.href='job_inputs.php?input=units&remove='+id;
		} else {
		    swal("Cancelled", "Unit is not removed!", "error");
		}
	});
}