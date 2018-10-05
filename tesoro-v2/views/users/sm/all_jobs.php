<?php
	include ('config/sm_verify.php');

	$count_query="SELECT count(*) AS 'ucount' FROM jo";
	$count_result=mysqli_query($conn,$count_query);

	$counts_query="SELECT count(*) AS 'ucount' FROM jo a LEFT JOIN jo_kinds b ON a.job_kind=b.id LEFT JOIN jo_type c ON b.job_type=c.id WHERE c.id=2";
	$counts_result=mysqli_query($conn,$counts_query);

	$countb_query="SELECT count(*) AS 'ucount' FROM jo a LEFT JOIN jo_kinds b ON a.job_kind=b.id LEFT JOIN jo_type c ON b.job_type=c.id WHERE c.id=1";
	$countb_result=mysqli_query($conn,$countb_query);

	$countbs_query="SELECT count(*) AS 'ucount' FROM jo a LEFT JOIN jo_kinds b ON a.job_kind=b.id LEFT JOIN jo_type c ON b.job_type=c.id WHERE c.id=3";
	$countbs_result=mysqli_query($conn,$countbs_query);
?>

<!DOCTYPE html>
<html>
<head>
	<?php include ('include/head.php');?>
</head>

<style type="text/css">
	.nav-jo {
		text-decoration: none;
		color: #fff;
		background: rgba(0,0,0,.4);
	}

	thead,tbody {
		font-size: 15px;
	}
</style>

<body>
	<?php include ('include/navbar.php'); ?>
	<div class="container-fluid">
		<div id="content">
			<div class="row">
				<div class="col-md-12"><?php
					if(
					(isset($_GET['view']) || !isset($_GET['copies']) && !isset($_GET['remove']) && !isset($_GET['status'])) && 
					(!isset($_GET['view']) || isset($_GET['copies']) && !isset($_GET['remove']) && !isset($_GET['status'])) &&
					(!isset($_GET['view']) || !isset($_GET['copies']) && isset($_GET['remove']) && !isset($_GET['status'])) &&
					(!isset($_GET['view']) || !isset($_GET['copies']) && !isset($_GET['remove']) && isset($_GET['status']))
					) {?>
						<div style="margin-top: 50px;"><?php
							if(isset($_GET['jobs'])){
								if($_GET['jobs']=='all'){
									include ('jobs/all.php');
								}else if($_GET['jobs']=='big'){
									include ('jobs/big.php');
								}else if($_GET['jobs']=='bigsmall'){
									include ('jobs/bigsmall.php');
								}else if($_GET['jobs']=='small'){
									include ('jobs/small.php');
								}
							}?>
						</div><?php
					}else{?>
						<div style="margin-top: 50px;">
							<ul id="tabsJustified" class="nav nav-tabs">
								<li class="nav-item">
									<a href="all_jobs.php?jobs=all" class="nav-link small text-uppercase">
										All Jobs
										<span class="float-right badge badge-pill badge-danger" style="margin-left:10px"><?php
											if(mysqli_num_rows($count_result)>0){
												while($count=mysqli_fetch_assoc($count_result)){
													echo $count['ucount'];
												}
											}?>
										</span>
									</a>
								</li><?php
								$jt_query = "SELECT * FROM jo_type ORDER BY job_type ASC";
								$jt_result=mysqli_query($conn,$jt_query);
								if(mysqli_num_rows($jt_result)>0){
									while($jt=mysqli_fetch_assoc($jt_result)){
										if($jt['id']==1){?>
											<li class="nav-item">
												<a href="all_jobs.php?jobs=big" class="nav-link small text-uppercase">
													<?php echo $jt['job_type']." Jobs";?>
													<span class="float-right badge badge-pill badge-danger" style="margin-left:10px"><?php
														if(mysqli_num_rows($countb_result)>0){
															while($countb=mysqli_fetch_assoc($countb_result)){
																echo $countb['ucount'];
															}
														}?>
													</span>
												</a>
											</li><?php
										}else if($jt['id']==3){?>
											<li class="nav-item">
												<a href="all_jobs.php?jobs=bigsmall" class="nav-link small text-uppercase">
													<?php echo $jt['job_type']." Jobs";?>
													<span class="float-right badge badge-pill badge-danger" style="margin-left:10px"><?php
														if(mysqli_num_rows($countbs_result)>0){
															while($countbs=mysqli_fetch_assoc($countbs_result)){
																echo $countbs['ucount'];
															}
														}?>
													</span>
												</a>
											</li><?php
										}else if($jt['id']==2){?>
											<li class="nav-item">
												<a href="all_jobs.php?jobs=small" class="nav-link small text-uppercase">
													<?php echo $jt['job_type']." Jobs";?>
													<span class="float-right badge badge-pill badge-danger" style="margin-left:10px"><?php
														if(mysqli_num_rows($counts_result)>0){
															while($counts=mysqli_fetch_assoc($counts_result)){
																echo $counts['ucount'];
															}
														}?>
													</span>
												</a>
											</li><?php
										}
									}
								}?>
							</ul><?php
							if(isset($_GET['view'])){
								include ('operations/job_orders/view_job_orders.php');
							} else if(isset($_GET['remove'])){
								include ('operations/job_orders/remove_job_orders.php');
							} else if(isset($_GET['status'])){
								include ('operations/job_orders/status_info.php');
							} else if(isset($_GET['copies'])){
								include ('operations/job_orders/copies_info.php');
							}?>
						</div><?php
					}?>
				</div>
			</div>
		</div>
	</div>
	<script src="js/system/jo.js"></script>
</body>
</html>