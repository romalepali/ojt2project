<?php
	include ('config/os_verify.php');
	$_SESSION['page']='all_notification.php';
	$tncount = 0;
	$pncount = 0;
?>

<!DOCTYPE html>
<html>
<head>
	<?php include ('include/head.php');?>
	<title>JOMIS | All Notifications</title>
</head>

<style type="text/css">
	thead,tbody {
		font-size: 15px;
	}
</style>

<body>
	<?php include ('include/navbar.php');?>
	<div class="container-fluid">
		<div id="content">
			<div class="row" style="padding-top: 55px;">
				<div class="col-md-12 mb-1">
					<h4>All Notifications</h4>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12" style="margin: 0px 10px;"><?php
					$tn_query = "SELECT *,DATE(published_on) AS 'pdate' FROM jo_notifications WHERE user_id=".$_SESSION['user_id']." ORDER BY published_on DESC";
					$tn_result = mysqli_query($conn,$tn_query);?>
					
					<div id="today">
						<a href="#" data-toggle="collapse" data-target="#collapseToday" aria-expanded="true" aria-controls="collapseToday">
							Today
						</a>
						<div id="collapseToday" class="collapse show" aria-labelledby="headingToday" data-parent="#today" style="margin: 0px 10px;">
							<div class="card-columns"><?php
								if(mysqli_num_rows($tn_result)>0){
									while($tn=mysqli_fetch_assoc($tn_result)){
										if(date('Y-m-d',strtotime($tn['pdate']))==date('Y-m-d',strtotime(date('Y-m-d')))){
											if($tn['status']=='unread'){?>
												<div class="card bg-light">
													<a href="javascript: void()" onClick="window.location='all_jobs.php?view=<?php echo $tn['job_no'];?>'">
														<div class="card-body">
															<p class="card-text"><?php echo $tn['message'];?></p>
															<h5 class="card-title"><?php echo "J.O. No.: ".$tn['job_no'];?></h5>
															<p class="card-text"><small class="text-muted"><?php echo date('F d, Y h:i A',strtotime($tn['published_on']));?></small></p>
														</div>
													</a>
												</div><?php
											}else{?>
												<div class="card">
													<a href="javascript: void()" onClick="window.location='all_jobs.php?view=<?php echo $tn['job_no'];?>'">
														<div class="card-body">
															<p class="card-text"><?php echo $tn['message'];?></p>
															<h5 class="card-title"><?php echo "J.O. No.: ".$tn['job_no'];?></h5>
															<p class="card-text"><small class="text-muted"><?php echo date('F d, Y h:i A',strtotime($tn['published_on']));?></small></p>
														</div>
													</a>
												</div><?php
											}
											$tncount++;
										}
									}
								}
								
								if($tncount==0){?>
									No Notifications Yet!<?php
								}?>
							</div>
						</div>
					</div><?php
					
					$pn_query = "SELECT *,DATE(published_on) AS 'pdate' FROM jo_notifications WHERE user_id=".$_SESSION['user_id']." ORDER BY published_on DESC";
					$pn_result = mysqli_query($conn,$tn_query);?>
					
					<div id="prev">
						<a href="#" data-toggle="collapse" data-target="#collapsePrev" aria-expanded="true" aria-controls="collapsePrev">
							Previous
						</a>
						<div id="collapsePrev" class="collapse" aria-labelledby="headingPrev" data-parent="#prev" style="margin: 0px 10px;">
							<div class="card-columns"><?php
								if(mysqli_num_rows($pn_result)>0){
									while($pn=mysqli_fetch_assoc($pn_result)){
										if(date('Y-m-d',strtotime($pn['pdate']))!=date('Y-m-d',strtotime(date('Y-m-d')))){
											if($pn['status']=='unread'){?>
												<div class="card bg-light">
													<a href="javascript: void()" onClick="window.location='all_jobs.php?view=<?php echo $pn['job_no'];?>'">
														<div class="card-body">
															<p class="card-text"><?php echo $pn['message'];?></p>
															<h5 class="card-title"><?php echo "J.O. No.: ".$pn['job_no'];?></h5>
															<p class="card-text"><small class="text-muted"><?php echo date('F d, Y h:i A',strtotime($pn['published_on']));?></small></p>
														</div>
													</a>
												</div><?php
											}else{?>
												<div class="card">
													<a href="javascript: void()" onClick="window.location='all_jobs.php?view=<?php echo $pn['job_no'];?>'">
														<div class="card-body">
															<p class="card-text"><?php echo $pn['message'];?></p>
															<h5 class="card-title"><?php echo "J.O. No.: ".$pn['job_no'];?></h5>
															<p class="card-text"><small class="text-muted"><?php echo date('F d, Y h:i A',strtotime($pn['published_on']));?></small></p>
														</div>
													</a>
												</div><?php
											}
											$pncount++;
										}
									}
								}
								
								if($pncount==0){?>
									No Notifications Yet!<?php
								}?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>