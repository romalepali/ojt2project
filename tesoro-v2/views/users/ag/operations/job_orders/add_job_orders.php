<title>Job Orders | Add New</title>
<?php
	if(isset($_GET['add']) && $_GET['add']=='2'){?>
		<div class="row">
			<div class="col-10">
				<h4 style="margin: 8px 0px;">Add New Jobbing (Small Job)</h4>
			</div>
		</div>
		<div style="padding: 0px 10px"><?php
			include ('add/add_small.php');
		?></div><?php
	}else if(isset($_GET['add']) && $_GET['add']=='1'){?>
		<div class="row">
			<div class="col-10">
				<h4 style="margin: 8px 0px;">Add New Jobbing (Big Job)</h4>
			</div>
		</div>
		<div style="padding: 0px 10px"><?php
			include ('add/add_big.php');
		?></div><?php
	}else if(isset($_GET['add']) && $_GET['add']=='3'){?>
		<div class="row">
			<div class="col-10">
				<h4 style="margin: 8px 0px;">Add New Jobbing (Big Job - Small)</h4>
			</div>
		</div>
		<div style="padding: 0px 10px"><?php
			include ('add/add_big_small.php');
		?></div><?php
	}else {?>
		<div style="padding: 20px 10px">
	 		Invalid Input! <a class="btn btn-primary" href="index.php">Back</a>
		</div>
	<?php
	}
?>