<?php
	if(is_numeric($_GET['add_copy']) && $_GET['add_copy']!=0){
		$test_query="SELECT a.job_no,a.deadline_on,b.job_type FROM jo a INNER JOIN jo_kinds b ON a.job_kind=b.id WHERE a.job_no=".$_GET['add_copy'];

		$test_result=mysqli_query($conn,$test_query);
		if(mysqli_num_rows($test_result)>0){
	 		$test=mysqli_fetch_array($test_result);?>
			<title>J.O. No.: <?php echo $_GET['add_copy'];?> | Add New Copy</title>
	 		<div class="row">
				<div class="col-10">
					<h4 style="margin: 10px 0px;">J.O. No.: <?php echo $test['job_no'];?></h4>
				</div>
			</div>
	 		<div style="max-height: 75vh; overflow-x: hidden; padding: 0px 10px"><?php
	 			if($test['job_type']==1){
					//Big Jobs Only
					include ('add_copy/add_copy_big.php');
				}
				else if($test['job_type']==2){
					//Small Jobs Only
					include ('add_copy/add_copy_small.php');
				}
				else if($test['job_type']==3){
					include ('add_copy/add_copy_big_small.php');
				}?>
			</div><?php
		} else {?>
			<div style="padding: 20px 10px">
				Sorry, job does not exist! <a class="btn btn-primary" href="index.php">Back</a>
			</div><?php
		} 
	}else {?>
		<div style="padding: 20px 10px">
			Sorry, job does not exist! <a class="btn btn-primary" href="index.php">Back</a>
		</div><?php
	}
?>