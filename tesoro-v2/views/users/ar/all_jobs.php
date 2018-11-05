<?php
	include ('config/ar_verify.php');
	$_SESSION['page']='all_jobs.php';
?>

<!DOCTYPE html>
<html>
<head>
	<?php include ('include/head.php');?>
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
			<div class="row">
				<div class="col-md-12"><?php
					if(
						(isset($_GET['view']) || !isset($_GET['set_cr']) && !isset($_GET['set_ar']) && !isset($_GET['copies']) && !isset($_GET['status']) && !isset($_GET['update_stat']) && !isset($_GET['add_copy'])) && 
						(!isset($_GET['view']) || isset($_GET['set_cr']) && !isset($_GET['set_ar']) && !isset($_GET['copies']) && !isset($_GET['status']) && !isset($_GET['update_stat']) && !isset($_GET['add_copy'])) && 
						(!isset($_GET['view']) || !isset($_GET['set_cr']) && isset($_GET['set_ar']) && !isset($_GET['copies']) && !isset($_GET['status']) && !isset($_GET['update_stat']) && !isset($_GET['add_copy'])) &&
						(!isset($_GET['view']) || !isset($_GET['set_cr']) && !isset($_GET['set_ar']) && isset($_GET['copies']) && !isset($_GET['status']) && !isset($_GET['update_stat']) && !isset($_GET['add_copy'])) &&
						(!isset($_GET['view']) || !isset($_GET['set_cr']) && !isset($_GET['set_ar']) && !isset($_GET['copies']) && isset($_GET['status']) && !isset($_GET['update_stat']) && !isset($_GET['add_copy'])) &&
						(!isset($_GET['view']) || !isset($_GET['set_cr']) && !isset($_GET['set_ar']) && !isset($_GET['copies']) && isset($_GET['status']) && isset($_GET['update_stat']) && !isset($_GET['add_copy'])) && (!isset($_GET['view']) || !isset($_GET['set_cr']) && !isset($_GET['set_ar']) && !isset($_GET['copies']) && isset($_GET['status']) && isset($_GET['update_stat']) && isset($_GET['add_copy']))
					) {?>
						<div style="margin-top: 45px;"><?php
							if(isset($_GET['jobs'])){
								if($_GET['jobs']=='ogjo'){
									include ('jobs/ogjo.php');
								}else if($_GET['jobs']=='iajo'){
									include ('jobs/iajo.php');
								}
							}?>
						</div><?php
					}else{?>
						<div style="margin-top: 45px;"><?php						
							if(isset($_GET['view'])){
								include ('operations/job_orders/view_job_orders.php');
							}else if(isset($_GET['set_cr'])){
								include ('operations/job_orders/set_cover.php');
							}else if(isset($_GET['set_ar'])){
								include ('operations/job_orders/set_artist.php');
							}else if(isset($_GET['copies'])){
								include ('operations/job_orders/copies_info.php');
							}else if(isset($_GET['status'])){
								include ('operations/job_orders/status_info.php');
							}else if(isset($_GET['update_stat'])){
								include ('operations/job_orders/update_status.php');
							}else if(isset($_GET['add_copy'])){
								include ('operations/job_orders/add_copy.php');
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