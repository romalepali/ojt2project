<?php
	include ('config/ag_verify.php');
?>

<!DOCTYPE html>
<html>
<head>
	<?php include ('include/head.php');?>
</head>

<style type="text/css">
	.nav-all{
		text-decoration: none;
		color: #fff;
		background: rgba(0,0,0,.4);
	}s
	thead,tbody {
		font-size: 15px;
	}
</style>

<body>
	<?php include ('include/navbar.php');?>
	<div class="container-fluid">
		<div id="content">
			<div class="row">
				<div class="col-md-12"><?php
					if(
						(isset($_GET['view']) || !isset($_GET['edit']) && !isset($_GET['add']) && !isset($_GET['copies']) && !isset($_GET['status'])) && 
						(!isset($_GET['view']) || !isset($_GET['edit']) && !isset($_GET['add']) && !isset($_GET['copies']) && !isset($_GET['status'])) && 
						(!isset($_GET['view']) || !isset($_GET['edit']) && isset($_GET['add']) && !isset($_GET['copies']) && !isset($_GET['status'])) &&
						(!isset($_GET['view']) || !isset($_GET['edit']) && !isset($_GET['add']) && isset($_GET['copies']) && !isset($_GET['status'])) &&
						(!isset($_GET['view']) || !isset($_GET['edit']) && !isset($_GET['add']) && !isset($_GET['copies']) && isset($_GET['status']))
					) {?>
						<div style="margin-top: 50px;"><?php
							if(isset($_GET['jobs'])){
								if($_GET['jobs']=='all'){
									include ('jobs/all.php');
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
								</li>
							</ul><?php
							if(isset($_GET['jobs'])){
								if(isset($_GET['view'])){
									include ('operations/job_orders/view_job_orders.php');
								}else if(isset($_GET['edit'])){
									include ('operations/job_orders/edit_job_orders.php');
								}else if(isset($_GET['add'])){
									include ('operations/job_orders/add_job_orders.php');
								}else if(isset($_GET['copies'])){
									include ('operations/job_orders/copies_info.php');
								}else if(isset($_GET['status'])){
									include ('operations/job_orders/status_info.php');
								}
							}?>
						</div><?php
					}?>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="choose">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Add New</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">
					<div class="row"><?php
						$jt_query = "SELECT * FROM jo_type ORDER BY job_type ASC";
						$jt_result=mysqli_query($conn,$jt_query);
						if(mysqli_num_rows($jt_result)>0){
							while($jt=mysqli_fetch_assoc($jt_result)){?>
								<div class="col mb-2">
									<a class="btn btn-secondary form-control" href="javascript: add('<?php echo $jt['id'];?>')"><?php echo $jt['job_type'];?></a>
								</div><?php
							}
						}else {?>
							<div class="col">
								Not Available
							</div><?php
						}?>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<script src="js/system/jo.js"></script>
</body>
</html>