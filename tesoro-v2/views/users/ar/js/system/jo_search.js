function update_stat(id)
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
		    window.location.href='search.php?update_stat='+id;
		} else {
		    swal("Cancelled", "Jobbing is not modified!", "error");
		}
	});
}

function view(id)
{
	window.location.href='search.php?view='+id;
}

function status(id)
{
	window.location.href='search.php?status='+id;
}

function copies(id)
{
	window.location.href='search.php?copies='+id;
}