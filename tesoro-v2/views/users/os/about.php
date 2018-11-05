<?php
	include ('config/os_verify.php');
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
					if(isset($_GET['type']) && $_GET['type']!=NULL){?>
						<div style="margin-top: 45px;"><?php						
							if($_GET['type']=='bugs'){
								include ('about/jomis_bugs.php');
							}else if($_GET['type']=='suggestions'){
								include ('about/jomis_suggestions.php');
							}?>
						</div><?php
					}?>
				</div>
			</div>
		</div>
	</div>
</body>
</html>