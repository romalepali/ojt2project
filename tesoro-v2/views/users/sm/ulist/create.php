<title>System Users | Create An Account</title>
<?php
	if(isset($_GET['create']) && ($_GET['create']>=1 && $_GET['create']<=9)){?>
		<div class="row">
			<div class="col-10">
				<h4 style="margin: 8px 0px;">Create An Account</h4>
			</div>
		</div>
		<div style="padding: 0px 10px"><?php
			include ('create/create.php');?>
		</div><?php
	}else {?>
		<div style="padding: 20px 10px">
	 		Invalid Input! <a class="btn btn-primary" href="index.php">Back</a>
		</div><?php
	}
?>