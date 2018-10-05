function update(id)
{
	swal({
			title: "Warning",
			text: "Are you sure to update this user!",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-danger",
			confirmButtonText: "Yes, update it!",
			cancelButtonText: "No, cancel please!",
			closeOnConfirm: false,
  			closeOnCancel: false
		},
		function(isConfirm){
		if (isConfirm) {
		    window.location.href='users_ac.php?update='+id;
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
			confirmButtonText: "Yes, remove it!",
			cancelButtonText: "No, cancel please!",
			closeOnConfirm: false,
  			closeOnCancel: false
		},
		function(isConfirm){
		if (isConfirm) {
		    window.location.href='users_ac.php?remove='+id;
		} else {
		    swal("Cancelled", "User is not removed!", "error");
		}
	});
}