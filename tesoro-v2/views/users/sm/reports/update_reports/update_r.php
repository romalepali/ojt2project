<?php
	if (isset($_POST['update_r_save'])) {
		$stat = $_POST['stat'];
		$r_save = "UPDATE system_reports SET status='$stat' WHERE id=".$_GET['update_r'];
		
		if(mysqli_query($conn,$r_save)){?>
			<script type="text/javascript">
				swal({
					title: "Success!",
					text: "Your changes are applied",
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
					title: "Failed!",
					text: "No changes applied",
					type: "error"
				},function(isConfirm){
					if(isConfirm){
						window.location.href='<?php echo $_SESSION['page'];?>';
					}
				});
			</script><?php
		}
	}

	$query="SELECT message,status AS 'stat' FROM system_reports WHERE id=".$_GET['update_r'];
	$result_set=mysqli_query($conn,$query);
	$row=mysqli_fetch_array($result_set);
?>

<form action="reports.php?update_r=<?php echo $_GET['update_r'];?>" method="POST">
	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="stat" class="col-12 col-form-label">Status</label>
				<div class="col-12">
					<select class="form-control" name="stat" id="stat" autofocus required><?php
						if($row['stat']=='New'){?>
							<option value="New" selected>New</option>
							<option value="On-Going">On-Going</option>
							<option value="Done">Done</option><?php
						}else if($row['stat']=='On-Going'){?>
							<option value="New">New</option>
							<option value="On-Going" selected>On-Going</option>
							<option value="Done">Done</option><?php
						}else if($row['stat']=='Done'){?>
							<option value="New">New</option>
							<option value="On-Going">On-Going</option>
							<option value="Done" selected>Done</option><?php
						}?>
					</select>
				</div>
			</div>
		</div>
	</div>
	
	<div style="float: right; padding: 20px 0px">
		<a class="btn btn-secondary" href="<?php echo $_SESSION['page'];?>">Cancel</a>
		<button class="btn btn-primary" type="submit" name="update_r_save">Save Changes</button>
	</div>
</form>