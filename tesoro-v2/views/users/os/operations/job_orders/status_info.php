<?php
	if(is_numeric($_GET['status']) && $_GET['status']!=0){
		$test_query="SELECT a.artist,a.job_no,a.deadline_on,b.job_type FROM jo a INNER JOIN jo_kinds b ON a.job_kind=b.id WHERE a.job_no=".$_GET['status'];

		$test_result=mysqli_query($conn,$test_query);
		if(mysqli_num_rows($test_result)>0){
			$test=mysqli_fetch_array($test_result);?>
			<title>J.O. No.: <?php echo $test['job_no'];?> | Status Updates</title>
			<div class="row">
				<div class="col-6">
					<h4 style="margin: 10px 0px;">J.O. No.: <?php echo $test['job_no'];?></h4>
				</div>
				<div class="col-6">
					<button class="btn btn-secondary" onclick="update_stat('<?php echo $_GET['status']; ?>')" style="font-size: 12px; height:32px; float: right; margin: 5px 0px 5px 5px;">
						UPDATE
					</button>
					<button class="btn btn-secondary" onclick="view('<?php echo $_GET['status']; ?>')" style="font-size: 12px; height:32px; float: right; margin: 5px 0px 5px 5px;">
						BACK
					</button>
				</div>
			</div>
			<div>
				<?php if($test['job_type']==1){
					include ('status/status_big.php');
				}
				else if($test['job_type']==2){
					include ('status/status_small.php');
				}
				else if($test['job_type']==3){
					include ('status/status_big_small.php');
				}?>
			</div>
		<?php
		} else {?>
			<div style="padding: 20px 10px">
				Sorry, job does not exist! <a class="btn btn-primary" href="index.php">Back</a>
			</div>
		<?php
		} 
	}else {?>
		<div style="padding: 20px 10px">
			Sorry, job does not exist! <a class="btn btn-primary" href="index.php">Back</a>
		</div>
	<?php
	}
?>