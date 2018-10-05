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
		    window.location.href='input_units.php?edit='+id;
		} else {
		    swal("Cancelled", "Unit is not modified!", "error");
		}
	});
}

function add(id)
{
	window.location.href='input_units.php?add='+id;
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
		    window.location.href='input_units.php?remove='+id;
		} else {
		    swal("Cancelled", "Unit is not removed!", "error");
		}
	});
}