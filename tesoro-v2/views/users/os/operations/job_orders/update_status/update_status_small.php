<?php
	if(isset($_POST['update_stat_small_save'])){
		$ub = $_SESSION['user_id'];
		$job_no = $_GET['update_stat'];
		$notes = mysqli_real_escape_string($conn,$_POST['notes']);
		$status = $_POST['status'];
		
		$small_save = "INSERT INTO jo_status (job_no,status,notes,updated_on,updated_by) VALUES ('$job_no','$status','$notes',NOW(),'$ub')";

		if(mysqli_query($conn,$small_save)){?>
			<script type="text/javascript">
				swal({
					title: "Success",
					text: "Your changes are applied!",
					type: "success"
				},
				function(isConfirm){
					if (isConfirm){
						window.location.href='<?php echo $_SESSION['page'];?>?view=<?php echo $_GET['update_stat']?>';
					}
				});
			</script><?php
		}else{?>
			<script type="text/javascript">
				swal({
					title: "Failed",
					text: "No changes applied!",
					type: "error"
				},
				function(isConfirm){
					if (isConfirm){
						window.location.href='<?php echo $_SESSION['page'];?>?view=<?php echo $_GET['update_stat']?>';
					}
				});
			</script><?php
		}
	}
?>

<form action="<?php echo $_SESSION['page'];?>?update_stat=<?php echo $_GET['update_stat'];?>" method="POST">
	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="status" class="col-12 col-form-label">Update Status</label>
				<div class="col-12">
					<select class="custom-select" name="status" id="status" required>
						<option value="" selected>None</option><?php
						$ustat_query="SELECT * FROM jos_list GROUP BY id";
						$ustat_result=mysqli_query($conn,$ustat_query);
						if(mysqli_num_rows($ustat_result)>0){
							while($ustat=mysqli_fetch_array($ustat_result)){
								?><option value='<?php echo $ustat['id'];?>'><?php echo $ustat['status'];?></option><?php
							}
						}
						else{?>
							Not Available<?php
						}?>
					</select>
				</div>
			</div>
		</div>
		<div class="col-xl">
			<div class="form-group row">
        		<label for="notes" class="col-12 col-form-label">Notes</label>
        		<div class="col-12">
          			<textarea class="form-control" rows="10" placeholder="Enter Notes" name="notes" id="notes" style="resize: none;"></textarea>
        		</div>
      		</div>
    	</div>
	</div>
	<div style="float: right; padding: 20px 0px">
		<a class="btn btn-secondary" href="<?php echo $_SESSION['page'];?>?view=<?php echo $_GET['update_stat'];?>">Cancel</a>
		<button class="btn btn-primary" type="submit" name="update_stat_small_save">Save Changes</button>
	</div>
</form>