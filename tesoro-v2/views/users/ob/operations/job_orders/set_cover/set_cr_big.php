<?php
	if(isset($_POST['set_cr_big_save'])){
		$cub = $_SESSION['user_id'];
		$big_save = "UPDATE jo SET cover_updated_by='$cub',cover_updated_on=NOW()";

		if(isset($_POST['cover']) && $_POST['cover']!=NULL){
			$cover = $_POST['cover'];
			$big_save .= ",cover='$cover'";
			
			$addn_query = "INSERT INTO jo_notifications (job_no,user_id,message,published_on,status,notify) VALUES (".$_GET['set_cr'].",".$cover.",'you are assigned to cover',NOW(),'unread','Yes')";
		}else{
			$big_save .= ",cover=NULL";
		}

		$big_save .= " WHERE job_no=".$_GET['set_cr'];

		if(mysqli_query($conn,$big_save) && mysqli_query($conn,$addn_query)){?>
			<script type="text/javascript">
				swal({
					title: "Success!",
					text: "Your changes are applied",
					type: "success"
				},
				function(isConfirm){
					if (isConfirm){
						window.location.href='<?php echo $_SESSION['page'];?>?view=<?php echo $_GET['set_cr']?>';
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
						window.location.href='<?php echo $_SESSION['page'];?>?view=<?php echo $_GET['set_cr']?>';
					}
				});
			</script><?php
		}
	}
?>

<form action="<?php echo $_SESSION['page'];?>?set_cr=<?php echo $_GET['set_cr'];?>" method="POST">
	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="cover" class="col-12 col-form-label">Set Cover</label>
				<div class="col-12">
					<select class="custom-select" name="cover" id="cover">
						<option value="" selected>None</option><?php
						$user_query="SELECT * FROM users_list GROUP BY lastname,firstname";
						$user_result=mysqli_query($conn,$user_query);
						if(mysqli_num_rows($user_result)>0){
							while($user=mysqli_fetch_array($user_result)){
								if($user['type']==4 || $user['type']==5 || $user['type']==7){
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
		<a class="btn btn-secondary" href="<?php echo $_SESSION['page'];?>?view=<?php echo $_GET['set_cr'];?>">Cancel</a>
		<button class="btn btn-primary" type="submit" name="set_cr_big_save">Save Changes</button>
	</div>
</form>