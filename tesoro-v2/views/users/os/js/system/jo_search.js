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

function upload_c(id)
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
		    window.location.href='search.php?upload_c='+id;
		} else {
		    swal("Cancelled", "Jobbing is not modified!", "error");
		}
	});
}

function upload_s(id)
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
		    window.location.href='search.php?upload_s='+id;
		} else {
		    swal("Cancelled", "Jobbing is not modified!", "error");
		}
	});
}

function add_copy(id)
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
		    window.location.href='search.php?add_copy='+id;
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