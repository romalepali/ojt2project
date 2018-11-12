<?php
	if (isset($_POST['edit_jk_save'])){
		$jk = $_POST['jk'];
		$jt = $_POST['jt'];
		$edit = $_SESSION['user_id'];

		$jk_save = "UPDATE jo_kinds SET job_kind='$jk',job_type='$jt',updated_by='$edit',updated_on=NOW() WHERE id=".$_GET['edit'];

		if(mysqli_query($conn,$jk_save)){?>
			<script type="text/javascript">
				swal({
					title: "Success",
					text: "Your changes are applied!",
					type: "success"
				},
				function(isConfirm) {
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
				},
				function(isConfirm) {
					if (isConfirm) {
						window.location.href='<?php echo $_SESSION['page'];?>';
					}
				});
			</script><?php
		}
	}

	$query="SELECT a.job_kind AS 'jk',a.job_type AS 'jtid',b.job_type AS 'jt' FROM jo_kinds a LEFT JOIN jo_type b ON a.job_type=b.id WHERE a.id=".$_GET['edit'];

	$result_set=mysqli_query($conn,$query);
	$row=mysqli_fetch_array($result_set);
?>
<form action="<?php echo $_SESSION['page'];?>&edit=<?php echo $_GET['edit'];?>" method="POST">
	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="jk" class="col-12 col-form-label">Job Kind</label>
				<div class="col-12">
					<input class="form-control" type="text" placeholder="Enter Kind of Job" value="<?php echo $row['jk'];?>" name="jk" id="jk" autofocus required>
				</div>
			</div>
		</div>

		<div class="col-xl">
			<div class="form-group row">
				<label for="jt" class="col-12 col-form-label">Job Type</label>
				<div class="col-12">
					<select class="custom-select" name="jt" id="jt" required>
						<option value="" disabled>Select</option><?php
						$jt_query="SELECT * FROM jo_type GROUP BY job_type ASC";
						$jt_result=mysqli_query($conn,$jt_query);
						
						if(mysqli_num_rows($jt_result)>0){
							while($jt=mysqli_fetch_array($jt_result)){
								if($jt['id']==$row['jtid']){?>
									<option value="<?php echo $jt['id'];?>" selected><?php echo $jt['job_type'];?></option><?php
								}else{?>
									<option value="<?php echo $jt['id'];?>"><?php echo $jt['job_type'];?></option><?php
								}
							}
						}else{?>
							Not Available<?php
						}?>
					</select>
				</div>
			</div>
		</div>
	</div>
	
	<div style="float: right; padding: 20px 0px">
		<a class="btn btn-secondary" href="<?php echo $_SESSION['page'];?>">Cancel</a>
		<button class="btn btn-primary" type="submit" name="edit_jk_save">Save Changes</button>
	</div>
</form>