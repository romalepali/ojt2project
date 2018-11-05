<?php
	include ('config/sm_verify.php');

	$count_query="SELECT count(*) AS 'ucount' FROM system_reports";
	$count_result=mysqli_query($conn,$count_query);

	$countb_query="SELECT count(*) AS 'ucount' FROM system_reports WHERE report_type=1";
	$countb_result=mysqli_query($conn,$countb_query);

	$counts_query="SELECT count(*) AS 'ucount' FROM system_reports WHERE report_type=2";
	$counts_result=mysqli_query($conn,$counts_query);
?>

<!DOCTYPE html>
<html>
<head>
	<?php include ('include/head.php');?>
</head>

<style type="text/css">
	.nav-reports {
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
				<div class="col-md-12">
					<div style="margin-top: 50px;"><?php
						if(isset($_GET['reports']) && $_GET['reports']!=NULL){
							if($_GET['reports']=='all'){
								include ('reports/all.php');
							}else if($_GET['reports']=='bugs'){
								include ('reports/bugs.php');
							}else if($_GET['reports']=='suggestions'){
								include ('reports/suggestions.php');
							}
						}else{
							include ('reports/update_reports.php');
						}?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="js/system/reports.js"></script>
</body>
</html>