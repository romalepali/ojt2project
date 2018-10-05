<?php
if (isset($_POST['add_jk_save'])) {
		$jk = $_POST['jk'];
		$jt = $_POST['jt'];
		$add = $_SESSION['TIMS_id'];

		$add_query = "INSERT INTO jobbings_kinds (type,kind_of_job,added_by) VALUES ('$jt','$jk','$add')";

		$duple_query="SELECT * FROM jobbings_kinds WHERE BINARY (kind_of_job='$jk' AND type='$jt')";
		$duple_result=mysqli_query($conn,$duple_query);
		$duple=mysqli_num_rows($duple_result);
				
		if($duple>0){
			?>
				<script type="text/javascript">
					swal({
						title: "Failed!",
						text: "Job kind already existed!",
						type: "error"
					},
					function(isConfirm) {
						if (isConfirm) {
							window.location.href='<?php echo $_SESSION['page'];?>';
						}
					});
				</script>
			<?php
		}
		else{
			if(mysqli_query($conn,$add_query))
			{
			?>
				<script type="text/javascript">
					swal({
						title: "Success!",
						text: "You added a new job kind!",
						type: "success"
					},
					function(isConfirm) {
						if (isConfirm) {
							window.location.href='<?php echo $_SESSION['page'];?>';
						}
					});
				</script>
				<?php
			}
			else
			{
				?>
					<script type="text/javascript">
						swal({
						title: "Failed!",
						text: "Error adding a job kind!",
						type: "error"
					},
					function(isConfirm) {
						if (isConfirm) {
							window.location.href='<?php echo $_SESSION['page'];?>';
						}
					});
					</script>
				<?php
			}
		}
	}
?>

<form action="<?php echo $_SESSION['page'];?>?add=true" method="POST">
	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="jk" class="col-12 col-form-label">Kind of Job</label>
				<div class="col-12">
					<input class="form-control" type="text" placeholder="Enter Kind of Job" name="jk" id="jk" required>
				</div>
			</div>
		</div>

		<div class="col-xl">
			<div class="form-group row">
				<label for="jt" class="col-12 col-form-label">Type of Job</label>
				<div class="col-12">
					<select class="custom-select" name="jt" id="jt" required>
						<option value="" disabled>Select</option>
						<?php
							$jt_query="SELECT * FROM jobbings_type GROUP BY job_type ASC";
							$jt_result=mysqli_query($conn,$jt_query);
							if(mysqli_num_rows($jt_result)>0)
							{
								while($jt=mysqli_fetch_array($jt_result))
								{
										?><option value='<?php echo $jt['id'];?>'><?php echo $jt['job_type'];?></option>"<?php
								}
							}
							else
							{
							?>
								Not Available
							<?php
							}
						?>
					</select>
				</div>
			</div>
		</div>
	</div>
	<div style="float: right; padding: 20px 0px">
			<a class="btn btn-secondary"href="<?php echo $_SESSION['page'];?>">Cancel</a>
			<button class="btn btn-primary" type="submit" name="add_jk_save">Save Job Kind</button>
	</div>
</form>