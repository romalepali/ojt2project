function edit(id)
{
	swal({
			title: "Warning",
			text: "Are you sure to modify this printing!",
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
		    window.location.href='input_printing.php?edit='+id;
		} else {
		    swal("Cancelled", "Printing is not modified!", "error");
		}
	});
}

function add(id)
{
	window.location.href='input_printing.php?add='+id;
}

function remove(id)
{
	swal({
			title: "Warning",
			text: "Are you sure to remove this printing!",
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
		    window.location.href='input_printing.php?remove='+id;
		} else {
		    swal("Cancelled", "Printing is not removed!", "error");
		}
	});
}