function edit(id)
{
	swal({
			title: "Warning",
			text: "Are you sure to modify this material!",
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
		    window.location.href='input_materials.php?edit='+id;
		} else {
		    swal("Cancelled", "Material is not modified!", "error");
		}
	});
}

function add(id)
{
	window.location.href='input_materials.php?add='+id;
}

function remove(id)
{
	swal({
			title: "Warning",
			text: "Are you sure to remove this material!",
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
		    window.location.href='input_materials.php?remove='+id;
		} else {
		    swal("Cancelled", "Material is not removed!", "error");
		}
	});
}