<?php
	if (isset($_POST['add_pm_save'])) {
		$pm = $_POST['pm'];
		$add = $_SESSION['user_id'];
		$add_query = "INSERT INTO jo_payments (payment,updated_by,updated_on) VALUES ('$pm','$add',NOW())";
		$duple_query="SELECT * FROM jo_payments WHERE BINARY (payment='$pm')";
		$duple_result=mysqli_query($conn,$duple_query);
		$duple=mysqli_num_rows($duple_result);
        
		if($duple>0){?>
			<script type="text/javascript">
				swal({
					title: "Failed",
					text: "Job payment already existed!",
					type: "error"
				},function(isConfirm) {
					if (isConfirm) {
						window.location.href='<?php echo $_SESSION['page'];?>';
					}
				});
			</script><?php
		}else{
			if(mysqli_query($conn,$add_query)){?>
				<script type="text/javascript">
					swal({
						title: "Success",
						text: "You added a new payment!",
						type: "success"
					},function(isConfirm) {
						if (isConfirm) {
							window.location.href='<?php echo $_SESSION['page'];?>';
						}
					});
				</script><?php
			}else{?>
				<script type="text/javascript">
					swal({
						title: "Failed",
						text: "Error adding a payment!",
						type: "error"
					},function(isConfirm) {
						if (isConfirm) {
							window.location.href='<?php echo $_SESSION['page'];?>';
						}
					});
				</script><?php
			}
		}
 	}
?>

<form action="<?php echo $_SESSION['page'];?>&add=true" method="POST">
	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="pm" class="col-12 col-form-label">Payment</label>
				<div class="col-12">
					<input class="form-control" type="text" placeholder="Enter Payment" name="pm" id="pm" autofocus required>
				</div>
			</div>
		</div>
	</div>
  
	<div style="float: right; padding: 20px 0px">
		<a class="btn btn-secondary"href="<?php echo $_SESSION['page'];?>">Cancel</a>
		<button class="btn btn-primary" type="submit" name="add_pm_save">Save Payment</button>
	</div>
</form>