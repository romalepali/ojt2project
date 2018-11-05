<?php
	if(is_numeric($_GET['update_r']) && $_GET['update_r']!=0){
		$query0="SELECT * FROM system_reports WHERE id=".$_GET['update_r'];
		$result_set0=mysqli_query($conn,$query0);
		
		if(mysqli_num_rows($result_set0)>0){
			$row0=mysqli_fetch_array($result_set0);?>
			<title>Update Report | ID <?php echo $row0['id'];?></title>
			<div class="row">
				<div class="col-10">
					<h4 style="margin: 10px 0px;">Report ID <?php echo $row0['id'];?></h4>
				</div>
			</div>
			<div style="padding: 0px 10px"><?php
				include ('update_reports/update_r.php');?>
			</div><?php
		}else{?>
			<div style="padding: 20px 10px">
				Sorry, Report ID does not exist! <a class="btn btn-primary" href="index.php">Back</a>
			</div><?php
		} 
 	}else{?>
		<div style="padding: 20px 10px">
	 		Sorry, Report ID does not exist! <a class="btn btn-primary" href="index.php">Back</a>
		</div><?php
	}
?>