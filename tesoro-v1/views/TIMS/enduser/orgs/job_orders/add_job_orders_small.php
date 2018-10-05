<?php
	if(isset($_GET['add']) && $_GET['add']=='small'){?>
		<div class="row">
			<div class="col-10">
				<h4 style="margin: 8px 0px;">Add New Jobbing (Small Job)</h4>
			</div>
		</div>
		<div style="overflow-x: hidden; padding: 0px 10px"><?php
			include ('add/add_small.php');
		?></div><?php
	}else if(isset($_GET['add']) && $_GET['add']=='big'){?>
		<div style="max-height: 75vh; overflow-x: hidden; padding: 20px 10px">
	 		Sorry, you can't add a small job on a big job! <a class="btn btn-primary" href="<?php echo $_SESSION['page'];?>">Back</a>
		</div><?php
	}else if(isset($_GET['add']) && $_GET['add']=='big_small'){?>
		<div style="max-height: 75vh; overflow-x: hidden; padding: 20px 10px">
	 		Sorry, you can't add a small job on a big job - small! <a class="btn btn-primary" href="<?php echo $_SESSION['page'];?>">Back</a>
		</div><?php
	}else {?>
		<div style="max-height: 75vh; overflow-x: hidden; padding: 20px 10px">
	 		Invalid Input! <a class="btn btn-primary" href="<?php echo $_SESSION['page'];?>">Back</a>
		</div>
	<?php
	}
?>