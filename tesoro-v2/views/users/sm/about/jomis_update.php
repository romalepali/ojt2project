<?php
	if (isset($_POST['update_system'])){
		$appname = mysqli_real_escape_string($conn,$_POST['appname']);
		$appversion = mysqli_real_escape_string($conn,$_POST['appversion']);
		$appstatus = $_POST['appstatus'];
		$updated_by = $_SESSION['user_id'];
		
		$update_system = "INSERT INTO system_info (app_name,app_version,app_status,updated_by,updated_on) VALUES ('$appname','$appversion','$appstatus','$updated_by',NOW())";
		
		$duple_query="SELECT * FROM system_info WHERE BINARY (app_version='$appversion' AND app_status='$appstatus')";
		$duple_result=mysqli_query($conn,$duple_query);
		$duple=mysqli_num_rows($duple_result);
		
		if($duple>0){?>
			<script type="text/javascript">
				swal({
					title: "Already Updated",
					text: "Please update to other version!",
					type: "info"
				},function(isConfirm){
					if(isConfirm){
						window.location.href='about.php?type=update_system';
					}
				});
			</script><?php
		}else{
			if(mysqli_query($conn,$update_system)){?>
				<script type="text/javascript">
					swal({
						title: "Success",
						text: "You updated the system!",
						type: "success"
					},function(isConfirm) {
						if (isConfirm) {
							window.location.href='index.php';
						}
					});
				</script><?php
			}else{?>
				<script type="text/javascript">
					swal({
						title: "Failed",
						text: "Error updating the system!",
						type: "error"
					},function(isConfirm) {
						if (isConfirm) {
							window.location.href='index.php';
						}
					});
				</script><?php
			}
		}
	}
?>

<title>About JOMIS | Update System</title>
<div class="row">
	<div class="col-10">
		<h4 style="margin: 8px 0px;">Update System</h4>
	</div>
</div>

<div style="padding: 0px 10px">
	<form action="about.php?type=update_system" method="POST"><?php
		$an_query="SELECT a.app_name,a.app_version,a.app_status FROM system_info a ORDER BY a.updated_on DESC LIMIT 1";
		$an_result=mysqli_query($conn,$an_query);
		if(mysqli_num_rows($an_result)>0){
			while($an=mysqli_fetch_assoc($an_result)){?>
				<div class="row">
					<div class="col-xl">
						<div class="form-group row">
							<label for="appname" class="col-12 col-form-label">App Name</label>
							<div class="col-12">						
								<input class="form-control" value="<?php echo $an['app_name'];?>" placeholder="Enter App Name" name="appname" id="appname">
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-xl">
						<div class="form-group row">
							<label for="appversion" class="col-12 col-form-label">App Version</label>
							<div class="col-12">
								<input class="form-control" value="<?php echo $an['app_version'];?>" placeholder="Enter App Version" name="appversion" id="appversion">
							</div>
						</div>
					</div>

					<div class="col-xl">
						<div class="form-group row">
							<label for="appstatus" class="col-12 col-form-label">App Status</label>
							<div class="col-12">
								<select class="form-control" name="appstatus" id="appstatus"><?php
									if($an['app_status']=='BETA'){?>
										<option value="BETA" selected>BETA</option>
										<option value="OFFICIAL">OFFICIAL</option><?php
									}else if($an['app_status']=='OFFICIAL'){?>
										<option value="BETA">BETA</option>
										<option value="OFFICIAL" selected>OFFICIAL</option><?php
									}?>
								</select>
							</div>
						</div>
					</div>
				</div><?php
			}
		}?>

		<div style="float: right; padding: 20px 0px">
			<button class="btn btn-primary" type="submit" name="update_system">Update</button>
		</div>
	</form>
</div>