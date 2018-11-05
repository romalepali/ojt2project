<?php
	if(isset($_POST['set_ar_small_save'])){
		$aab = $_SESSION['user_id'];
		$small_save = "UPDATE jo SET artist_assigned_by='$aab',artist_assigned_on=NOW()";

		if(isset($_POST['artist']) && $_POST['artist']!=NULL){
			$artist = $_POST['artist'];
			$small_save .= ",artist='$artist'";
			
			$addn_query = "INSERT INTO jo_notifications (job_no,user_id,message,published_on,status,notify) VALUES (".$_GET['set_ar'].",".$artist.",'you are assigned to layout',NOW(),'unread','Yes')";
		}else{
			$small_save .= ",artist=NULL";
		}

		$small_save .= " WHERE job_no=".$_GET['set_ar'];

		if(mysqli_query($conn,$small_save) && mysqli_query($conn,$addn_query)){?>
			<script type="text/javascript">
				swal({
					title: "Success!",
					text: "Your changes are applied",
					type: "success"
				},
				function(isConfirm){
					if (isConfirm){
						window.location.href='<?php echo $_SESSION['page'];?>?view=<?php echo $_GET['set_ar']?>';
					}
				});
			</script><?php
		}else{?>
			<script type="text/javascript">
				swal({
					title: "Failed!",
					text: "No changes applied",
					type: "error"
				},
				function(isConfirm){
					if (isConfirm){
						window.location.href='<?php echo $_SESSION['page'];?>?view=<?php echo $_GET['set_ar']?>';
					}
				});
			</script><?php
		}
	}
?>

<form action="<?php echo $_SESSION['page'];?>?set_ar=<?php echo $_GET['set_ar'];?>" method="POST">
	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="artist" class="col-12 col-form-label">Set Artist</label>
				<div class="col-12">
					<select class="custom-select" name="artist" id="artist" required>
						<option value="" selected>None</option><?php
						$user_query="SELECT * FROM users_list GROUP BY lastname,firstname";
						$user_result=mysqli_query($conn,$user_query);
						if(mysqli_num_rows($user_result)>0){
							while($user=mysqli_fetch_array($user_result)){
								if($user['type']==4 ||  $user['type']=5 || $user['type']==7){
									?><option value='<?php echo $user['id'];?>'><?php echo $user['lastname'].", ".$user['firstname'];?></option><?php
								}
							}
						}
						else{?>
							Not Available<?php
						}?>
					</select>
				</div>
			</div>
		</div>
	</div>
	<div style="float: right; padding: 20px 0px">
		<a class="btn btn-secondary" href="<?php echo $_SESSION['page'];?>?view=<?php echo $_GET['set_ar'];?>">Cancel</a>
		<button class="btn btn-primary" type="submit" name="set_ar_small_save">Save Changes</button>
	</div>
</form>