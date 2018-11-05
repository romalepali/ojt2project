function edit(id)
{
	swal({
			title: "Warning",
			text: "Are you sure to modify this jobbing!",
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
		    window.location.href='all_jobs.php?jobs=all&edit='+id;
		} else {
		    swal("Cancelled", "Jobbing is not modified!", "error");
		}
	});
}

function view(id)
{
	window.location.href='all_jobs.php?jobs=all&view='+id;
}

function add(id)
{
	window.location.href='all_jobs.php?jobs=all&add='+id;
}

function status(id)
{
	window.location.href='all_jobs.php?jobs=all&status='+id;
}

function copies(id)
{
	window.location.href='all_jobs.php?jobs=all&copies='+id;
}