function update(id)
{
	swal({
			title: "Warning",
			text: "Are you sure to update this user!",
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
		    window.location.href='users.php?update='+id;
		} else {
		    swal("Cancelled", "User is not updated!", "error");
		}
	});
}

function remove(id)
{
	swal({
			title: "Warning",
			text: "Are you sure to remove this user!",
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
		    window.location.href='users.php?remove='+id;
		} else {
		    swal("Cancelled", "User is not removed!", "error");
		}
	});
}

function create(id)
{
	window.location.href='users.php?create='+id;
}