<?php
	if(isset($_POST['add_copy_big_small_save'])){
		$ab = $_SESSION['user_id'];
		$job_no = $_GET['add_copy'];
		$copies = $_POST['copies'];
		
		$big_small_save1 = "INSERT INTO jo_copies (job_no,copies,added_on,added_by";
		$big_small_save2 = "VALUES ('$job_no','$copies',NOW(),'$ab'";
		
		if(isset($_POST['units']) && $_POST['units']!=NULL){
			$units = $_POST['units'];
			$big_small_save1 .= ",units)";
			$big_small_save2 .= ",'$units')";
		}else{
			$big_small_save1 .= ",units)";
			$big_small_save2 .= ",NULL)";
		}
		
		$big_small_save = $big_small_save1." ".$big_small_save2;

		if(mysqli_query($conn,$big_small_save)){?>
			<script type="text/javascript">
				swal({
					title: "Success!",
					text: "Your changes are applied",
					type: "success"
				},
				function(isConfirm){
					if (isConfirm){
						window.location.href='<?php echo $_SESSION['page'];?>?view=<?php echo $_GET['add_copy']?>';
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
						window.location.href='<?php echo $_SESSION['page'];?>?view=<?php echo $_GET['add_copy']?>';
					}
				});
			</script><?php
		}
	}
?>

<form action="<?php echo $_SESSION['page'];?>?add_copy=<?php echo $_GET['add_copy'];?>" method="POST">
	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="copies" class="col-12 col-form-label">Copies</label>
				<div class="col-12">
					<input class="form-control" type="number" placeholder="Enter Copies" name="copies" id="copies" required>
				</div>
			</div>
		</div>
		
		<div class="col-xl">
			<div class="form-group row">
				<label for="units" class="col-12 col-form-label">Units</label>
				<div class="col-12">
					<select class="custom-select" name="units" id="units">
						<option value="" selected>None</option><?php
						$units_query="SELECT * FROM joc_units GROUP BY units";
						$units_result=mysqli_query($conn,$units_query);
						if(mysqli_num_rows($units_result)>0){
							while($units=mysqli_fetch_array($units_result)){
								?><option value='<?php echo $units['id'];?>'><?php echo $units['units'];?></option><?php
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
		<a class="btn btn-secondary" href="<?php echo $_SESSION['page'];?>?view=<?php echo $_GET['add_copy'];?>">Cancel</a>
		<button class="btn btn-primary" type="submit" name="add_copy_big_small_save">Save Changes</button>
	</div>
</form>