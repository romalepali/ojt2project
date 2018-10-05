function edit(id)
{
	swal({
			title: "Warning",
			text: "Are you sure to modify this paper size!",
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
		    window.location.href='job_inputs.php?input=paper_size&edit='+id;
		} else {
		    swal("Cancelled", "Paper size is not modified!", "error");
		}
	});
}

function add(id)
{
	window.location.href='job_inputs.php?input=paper_size&add='+id;
}

function remove(id)
{
	swal({
			title: "Warning",
			text: "Are you sure to remove this paper size!",
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
		    window.location.href='job_inputs.php?input=paper_size&remove='+id;
		} else {
		    swal("Cancelled", "Paper size is not removed!", "error");
		}
	});
}