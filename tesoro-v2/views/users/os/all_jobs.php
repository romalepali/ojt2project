<?php
	include ('config/os_verify.php');
	$_SESSION['page']='all_jobs.php';
?>

<!DOCTYPE html>
<html>
<head>
	<?php include ('include/head.php');?>
</head>

<style type="text/css">
	.nav-job-orders {
		text-decoration: none;
		color: #fff;
		background: rgba(0,0,0,.4);
	}

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
						(isset($_GET['view']) || !isset($_GET['set_cr']) && !isset($_GET['set_ar']) && !isset($_GET['copies']) && !isset($_GET['status']) && !isset($_GET['update_stat']) && !isset($_GET['add_copy']) && !isset($_GET['upload_c']) && !isset($_GET['upload_s'])) && 
						(!isset($_GET['view']) || isset($_GET['set_cr']) && !isset($_GET['set_ar']) && !isset($_GET['copies']) && !isset($_GET['status']) && !isset($_GET['update_stat']) && !isset($_GET['add_copy']) && !isset($_GET['upload_c']) && !isset($_GET['upload_s'])) && 
						(!isset($_GET['view']) || !isset($_GET['set_cr']) && isset($_GET['set_ar']) && !isset($_GET['copies']) && !isset($_GET['status']) && !isset($_GET['update_stat']) && !isset($_GET['add_copy']) && !isset($_GET['upload_c']) && !isset($_GET['upload_s'])) &&
						(!isset($_GET['view']) || !isset($_GET['set_cr']) && !isset($_GET['set_ar']) && isset($_GET['copies']) && !isset($_GET['status']) && !isset($_GET['update_stat']) && !isset($_GET['add_copy']) && !isset($_GET['upload_c']) && !isset($_GET['upload_s'])) &&
						(!isset($_GET['view']) || !isset($_GET['set_cr']) && !isset($_GET['set_ar']) && !isset($_GET['copies']) && isset($_GET['status']) && !isset($_GET['update_stat']) && !isset($_GET['add_copy']) && !isset($_GET['upload_c']) && !isset($_GET['upload_s'])) &&
						(!isset($_GET['view']) || !isset($_GET['set_cr']) && !isset($_GET['set_ar']) && !isset($_GET['copies']) && !isset($_GET['status']) && isset($_GET['update_stat']) && !isset($_GET['add_copy']) && !isset($_GET['upload_c']) && !isset($_GET['upload_s'])) &&
						(!isset($_GET['view']) || !isset($_GET['set_cr']) && !isset($_GET['set_ar']) && !isset($_GET['copies']) && !isset($_GET['status']) && !isset($_GET['update_stat']) && isset($_GET['add_copy']) && !isset($_GET['upload_c']) && !isset($_GET['upload_s'])) &&
						(!isset($_GET['view']) || !isset($_GET['set_cr']) && !isset($_GET['set_ar']) && !isset($_GET['copies']) && !isset($_GET['status']) && !isset($_GET['update_stat']) && !isset($_GET['add_copy']) && isset($_GET['upload_c']) && !isset($_GET['upload_s'])) &&
						(!isset($_GET['view']) || !isset($_GET['set_cr']) && !isset($_GET['set_ar']) && !isset($_GET['copies']) && !isset($_GET['status']) && !isset($_GET['update_stat']) && !isset($_GET['add_copy']) && !isset($_GET['upload_c']) && isset($_GET['upload_s']))
					) {?>
						<div style="margin-top: 45px;"><?php
							if(isset($_GET['jobs'])){
								if($_GET['jobs']=='myjo'){
									include ('jobs/myjo.php');
								}else if($_GET['jobs']=='uajo'){
									include ('jobs/uajo.php');
								}else if($_GET['jobs']=='ogjo'){
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
							}else if(isset($_GET['upload_c'])){
								include ('operations/job_orders/upload_c.php');
							}else if(isset($_GET['upload_s'])){
								include ('operations/job_orders/upload_s.php');
							}?>
						</div><?php
					}?>
				</div>
			</div>
		</div>
	</div>
	<script src="js/system/jo.js"></script>

	<script type="text/javascript">
		document.getElementById("file").onchange = function() {
			document.getElementById("form").submit();
		};
	</script>
</body>
</html>