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
		    window.location.href='clients_big_jobs_small.php?edit='+id;
		} else {
		    swal("Cancelled", "Jobbing is not modified!", "error");
		}
	});
}

function update(id)
{
	swal({
			title: "Warning",
			text: "Are you sure to update this jobbing!",
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
		    window.location.href='clients_big_jobs_small.php?update='+id;
		} else {
		    swal("Cancelled", "Jobbing is not updated!", "error");
		}
	});
}

function view(id)
{
	window.location.href='clients_big_jobs_small.php?view='+id;
}

function add(id)
{
	window.location.href='clients_big_jobs_small.php?add='+id;
}

function more(id)
{
	window.location.href='clients_big_jobs_small.php?more='+id;
}