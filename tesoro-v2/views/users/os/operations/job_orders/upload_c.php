<?php
	if(is_numeric($_GET['upload_c']) && $_GET['upload_c']!=0){
		$test_query="SELECT * FROM jo_status WHERE id=".$_GET['upload_c'];

		$test_result=mysqli_query($conn,$test_query);
		if(mysqli_num_rows($test_result)>0){
	 		$test=mysqli_fetch_array($test_result);?>
			<title>J.O. No.: <?php echo $test['job_no'];?> | Upload Correction</title>
	 		<div class="row">
				<div class="col-10">
					<h4 style="margin: 10px 0px;">J.O. No.: <?php echo $test['job_no'];?></h4>
				</div>
			</div>
	 		<div style="padding: 0px 10px"><?php
				include ('upload_c/upload_cf.php');?>
			</div><?php
		} else {?>
			<div style="padding: 20px 10px">
				Sorry, job status does not exist! <a class="btn btn-primary" href="index.php">Back</a>
			</div><?php
		} 
	}else {?>
		<div style="padding: 20px 10px">
			Sorry, job status does not exist! <a class="btn btn-primary" href="index.php">Back</a>
		</div><?php
	}
?>