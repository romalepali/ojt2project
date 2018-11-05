function update_r(id)
{
	swal({
			title: "Warning",
			text: "Are you sure to update this report!",
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
		    window.location.href='reports.php?update_r='+id;
		} else {
		    swal("Cancelled", "Report is not updated!", "error");
		}
	});
}