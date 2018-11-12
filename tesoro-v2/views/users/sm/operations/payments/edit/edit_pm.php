<?php
	if (isset($_POST['edit_pm_save'])) {
		$pm = $_POST['pm'];
		$edit = $_SESSION['user_id'];
		$pm_save = "UPDATE jo_payments SET payment='$pm',updated_by='$edit',updated_on=NOW() WHERE id=".$_GET['edit'];

		if(mysqli_query($conn,$pm_save)){?>
			<script type="text/javascript">
				swal({
					title: "Success",
					text: "Your changes are applied!",
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
					text: "No changes applied!",
					type: "error"
				},function(isConfirm) {
					if (isConfirm) {
						window.location.href='<?php echo $_SESSION['page'];?>';
					}
				});
			</script><?php
		}
	}

	$query="SELECT * FROM jo_payments WHERE id=".$_GET['edit'];
	$result_set=mysqli_query($conn,$query);
	$row=mysqli_fetch_array($result_set);
?>

<form action="<?php echo $_SESSION['page'];?>&edit=<?php echo $_GET['edit'];?>" method="POST">
	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="pm" class="col-12 col-form-label">Payment</label>
				<div class="col-12">
					<input class="form-control" type="text" placeholder="Enter Payment" value="<?php echo $row['payment'];?>" name="pm" id="pm" autofocus required>
				</div>
			</div>
		</div>
	</div>
	
	<div style="float: right; padding: 20px 0px">
		<a class="btn btn-secondary" href="<?php echo $_SESSION['page'];?>">Cancel</a>
		<button class="btn btn-primary" type="submit" name="edit_pm_save">Save Changes</button>
	</div>
</form>