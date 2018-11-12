<?php
	if (isset($_POST['edit_st_save'])) {
		$st = $_POST['st'];
		$edit = $_SESSION['user_id'];
		$st_save = "UPDATE jos_list SET status='$st',updated_by='$edit',updated_on=NOW() WHERE id=".$_GET['edit'];
    
		if(mysqli_query($conn,$st_save)){?>
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

	$query="SELECT * FROM jos_list WHERE id=".$_GET['edit'];
	$result_set=mysqli_query($conn,$query);
	$row=mysqli_fetch_array($result_set);
?>

<form action="<?php echo $_SESSION['page'];?>&edit=<?php echo $_GET['edit'];?>" method="POST">
	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="st" class="col-12 col-form-label">Status</label>
				<div class="col-12">
					<input class="form-control" type="text" placeholder="Enter Status" value="<?php echo $row['status'];?>" name="st" id="st" autofocus required>
				</div>
			</div>
		</div>
	</div>
	<div style="float: right; padding: 20px 0px">
		<a class="btn btn-secondary" href="<?php echo $_SESSION['page'];?>">Cancel</a>
		<button class="btn btn-primary" type="submit" name="edit_st_save">Save Changes</button>
	</div>
</form>