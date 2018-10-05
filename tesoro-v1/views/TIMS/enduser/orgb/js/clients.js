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
		    window.location.href='clients.php?edit='+id;
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
		    window.location.href='clients.php?update='+id;
		} else {
		    swal("Cancelled", "Jobbing is not updated!", "error");
		}
	});
}

function view(id)
{
	window.location.href='clients.php?view='+id;
}

function add(id)
{
	window.location.href='clients.php?add='+id;
}

function more(id)
{
	window.location.href='clients.php?more='+id;
}