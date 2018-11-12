function set_ar(id)
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
		    window.location.href='all_jobs.php?set_ar='+id;
		} else {
		    swal("Cancelled", "Jobbing is not modified!", "error");
		}
	});
}

function set_cr(id)
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
		    window.location.href='all_jobs.php?set_cr='+id;
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
		    window.location.href='all_jobs.php?update_stat='+id;
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
		    window.location.href='all_jobs.php?upload_c='+id;
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
		    window.location.href='all_jobs.php?upload_s='+id;
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
		    window.location.href='all_jobs.php?add_copy='+id;
		} else {
		    swal("Cancelled", "Jobbing is not modified!", "error");
		}
	});
}

function view(id)
{
	window.location.href='all_jobs.php?view='+id;
}

function status(id)
{
	window.location.href='all_jobs.php?status='+id;
}

function copies(id)
{
	window.location.href='all_jobs.php?copies='+id;
}