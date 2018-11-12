<?php
	include ('config/os_verify.php');
	$_SESSION['page']='reports.php';
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
	.nav-reports {
		text-decoration: none;
		color: #fff;
		background: rgba(0,0,0,.4);
	}
	th{
		font-size: 12px;
	}
	td{
		font-size: 13px;
	}
	.btn-secondary{
		background-color: #8B0000;
	}
	.yellow{
		background-color: #FFFF66;
	}
	.orange{
		background-color: #FFB266;
	}
	.red{
		background-color: #FF9999;
	}
	.white{
		background-color: white;
	}
	.green{
		background-color:#99FF99;
	}
	.gray{
		background-color:#A0A0A0;
	}
	select{
		margin-left: 6px;
		margin-right: 6px;
	}
</style>

<body>
	<?php include ('include/navbar.php');?>
	<div class="container-fluid">
		<div id="content">
			<div class="row">
				<div class="col-md-12" id="printArea" style="margin-top: 50px;"><?php
					include ('reports/filters.php');
					if($_SESSION['filter']=='daily'){
						include ('reports/daily.php');
					}else if($_SESSION['filter']=='weekly'){
						include ('reports/weekly.php');
					}else if($_SESSION['filter']=='monthly'){
						include ('reports/monthly.php');
					}else if($_SESSION['filter']=='yearly'){
						include ('reports/yearly.php');
					}?>
				</div>
			</div>
		</div>
	</div>
</body>
</html>