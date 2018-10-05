function edit(id)
{
	swal({
			title: "Warning",
			text: "Are you sure to modify this payment!",
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
		    window.location.href='input_payments.php?edit='+id;
		} else {
		    swal("Cancelled", "Payment is not modified!", "error");
		}
	});
}

function add(id)
{
	window.location.href='input_payments.php?add='+id;
}

function remove(id)
{
	swal({
			title: "Warning",
			text: "Are you sure to remove this payment!",
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
		    window.location.href='input_payments.php?remove='+id;
		} else {
		    swal("Cancelled", "Payment is not removed!", "error");
		}
	});
}