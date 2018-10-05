<?php
	if(isset($_GET['add']) && $_GET['add']=='small'){?>
		<div style="max-height: 75vh; overflow-x: hidden; padding: 20px 10px">
	 		Sorry, you can't add a big job - small on a small job! <a class="btn btn-primary" href="small_jobs.php?add=small">Add Small Jobbing</a>
		</div><?php
	}
	else if(isset($_GET['add']) && $_GET['add']=='big'){?>
		<div style="max-height: 75vh; overflow-x: hidden; padding: 20px 10px">
	 		Sorry, you can't add a big job - small on a big job! <a class="btn btn-primary" href="big_jobs.php?add=big">Add Small Jobbing</a>
		</div><?php
	}
	else if(isset($_GET['add']) && $_GET['add']=='big_small'){?>
		<div class="row">
			<div class="col-10">
				<h4 style="margin: 8px 0px;">Add New Jobbing (Big Job - Small)</h4>
			</div>
		</div>
		<div style="overflow-x: hidden; padding: 0px 10px"><?php
			include ('add/add_big_small.php');
		?></div><?php
	}else {?>
		<div style="max-height: 75vh; overflow-x: hidden; padding: 20px 10px">
	 		Invalid Input! <a class="btn btn-primary" href="<?php echo $_SESSION['page'];?>">Back</a>
		</div>
	<?php
	}
?>