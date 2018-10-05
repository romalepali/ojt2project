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
		    window.location.href='search.php?edit='+id;
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
		    window.location.href='search.php?update='+id;
		} else {
		    swal("Cancelled", "Jobbing is not updated!", "error");
		}
	});
}

function view(id)
{
	window.location.href='search.php?view='+id;
}

function more(id)
{
	window.location.href='search.php?more='+id;
}