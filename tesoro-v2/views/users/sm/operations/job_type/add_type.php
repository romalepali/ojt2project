<title>Job Type | Add New</title>
<?php
	if(isset($_GET['add']) && $_GET['add']=='true'){?>
		<div class="row">
			<div class="col-10">
				<h4 style="margin: 8px 0px;">Add New Job Type</h4>
			</div>
		</div>
		<div style="overflow-x: hidden; padding: 0px 10px"><?php
			include ('add/add_jt.php');?>
		</div><?php
	}else{?>
		<div style="max-height: 75vh; overflow-x: hidden; padding: 20px 10px">
	 		Invalid Input! <a class="btn btn-primary" href="index.php">Back</a>
		</div><?php
	}
?>