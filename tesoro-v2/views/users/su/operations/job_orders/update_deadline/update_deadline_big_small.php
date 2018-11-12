<?php
	if(isset($_POST['update_deadline_big_small_save'])){
		$ub = $_SESSION['user_id'];
		$deadline = $_POST['deadline'];
		$notif = "";
		
		if(isset($_POST['deadline']) && $_POST['deadline']!=NULL){
			$big_small_save = "UPDATE jo SET deadline_on='$deadline' WHERE job_no=".$_GET['update_deadline'];
		}else{
			$big_small_save = "UPDATE jo SET deadline_on=NULL WHERE job_no=".$_GET['update_deadline'];
		}
		
		$check_query="SELECT artist FROM jo WHERE job_no=".$_GET['update_deadline'];
		$check_result=mysqli_query($conn,$check_query);
		$check=mysqli_fetch_array($check_result);
		
		$notif = "INSERT INTO jo_notifications (job_no,user_id,message,published_on,status,notify) VALUES (".$_GET['update_deadline'].",".$check['artist'].",'deadline has been updated for',NOW(),'unread','Yes')";

		if(mysqli_query($conn,$big_small_save)){
			if($check['artist']!=NULL){
				mysqli_query($conn,$notif);
			}?>
			<script type="text/javascript">
				swal({
					title: "Success",
					text: "Your changes are applied!",
					type: "success"
				},
				function(isConfirm){
					if (isConfirm){
						window.location.href='<?php echo $_SESSION['page'];?>?view=<?php echo $_GET['update_deadline']?>';
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
						window.location.href='<?php echo $_SESSION['page'];?>?view=<?php echo $_GET['update_deadline']?>';
					}
				});
			</script><?php
		}
	}

	$query="SELECT deadline_on AS 'dd' FROM jo WHERE job_no=".$_GET['update_deadline'];

	$result_set=mysqli_query($conn,$query);
	$row=mysqli_fetch_array($result_set);
?>

<form action="<?php echo $_SESSION['page'];?>?update_deadline=<?php echo $_GET['update_deadline'];?>" method="POST">
	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
        		<label for="deadline" class="col-12 col-form-label">Deadline</label>
        		<div class="col-12">
          			<input type="date" class="form-control" rows="10" placeholder="YYYY-DD-MM" name="deadline" value="<?php if($row['dd']!=NULL){echo $row['dd'];}?>" id="deadline">
        		</div>
      		</div>
    	</div>
	</div>
	<div style="float: right; padding: 20px 0px">
		<a class="btn btn-secondary" href="<?php echo $_SESSION['page'];?>?view=<?php echo $_GET['update_deadline'];?>">Cancel</a>
		<button class="btn btn-primary" type="submit" name="update_deadline_big_small_save">Save Changes</button>
	</div>
</form>