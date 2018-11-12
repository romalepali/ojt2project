<?php
	if (isset($_POST['edit_cl_save'])) {
		$cl = $_POST['cl'];
		$edit = $_SESSION['user_id'];
		$cl_save = "UPDATE jo_colors SET color='$cl',updated_by='$edit',updated_on=NOW() WHERE id=".$_GET['edit'];
		
		if(mysqli_query($conn,$cl_save)){?>
			<script type="text/javascript">
				swal({
					title: "Success",
					text: "Your changes are applied!",
					type: "success"
				},function(isConfirm){
					if(isConfirm){
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
				},function(isConfirm){
					if(isConfirm){
						window.location.href='<?php echo $_SESSION['page'];?>';
					}
				});
			</script><?php
		}
	}

	$query="SELECT color AS 'cl' FROM jo_colors WHERE id=".$_GET['edit'];
	$result_set=mysqli_query($conn,$query);
	$row=mysqli_fetch_array($result_set);
?>

<form action="<?php echo $_SESSION['page'];?>&edit=<?php echo $_GET['edit'];?>" method="POST">
	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="cl" class="col-12 col-form-label">Color</label>
				<div class="col-12">
					<input class="form-control" type="text" placeholder="Enter Color" value="<?php echo $row['cl'];?>" name="cl" id="cl" autofocus required>
				</div>
			</div>
		</div>
	</div>
	
	<div style="float: right; padding: 20px 0px">
		<a class="btn btn-secondary" href="<?php echo $_SESSION['page'];?>">Cancel</a>
		<button class="btn btn-primary" type="submit" name="edit_cl_save">Save Changes</button>
	</div>
</form>