function view(id)
{
	window.location.href='all_jobs.php?view='+id;
}

function status(id)
{
	window.location.href='all_jobs.php?status='+id;
}

function copies(id)
{
	window.location.href='all_jobs.php?copies='+id;
}

function remove(id)
{
	swal({
			title: "Warning",
			text: "Are you sure to remove this jobbing!",
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
		    window.location.href='all_jobs.php?remove='+id;
		} else {
		    swal("Cancelled", "Jobbing is not removed!", "error");
		}
	});
}