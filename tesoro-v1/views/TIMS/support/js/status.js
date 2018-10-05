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
		    window.location.href='input_status.php?edit='+id;
		} else {
		    swal("Cancelled", "Status is not modified!", "error");
		}
	});
}

function add(id)
{
	window.location.href='input_status.php?add='+id;
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
		    window.location.href='input_status.php?remove='+id;
		} else {
		    swal("Cancelled", "Status is not removed!", "error");
		}
	});
}