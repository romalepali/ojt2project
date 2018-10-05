<?php
	if(is_numeric($_GET['edit']) && $_GET['edit']!=0){
		$query0="SELECT * FROM joc_units WHERE id=".$_GET['edit'];
		$result_set0=mysqli_query($conn,$query0);
		if(mysqli_num_rows($result_set0)>0){
			$row0=mysqli_fetch_array($result_set0);?>
			<title>Edit Units | <?php echo $row0['units'];?></title>
			<div class="row">
				<div class="col-10">
					<h4 style="margin: 10px 0px;"><?php echo $row0['units'];?></h4>
				</div>
			</div>
			<div style="padding: 0px 10px"><?php
				include ('edit/edit_un.php');?>
			</div><?php
		}else {?>
			<div style="padding: 20px 10px">
				Sorry, units does not exist! <a class="btn btn-primary" href="index.php">Back</a>
			</div><?php
		} 
 	}else {?>
		<div style="padding: 20px 10px">
	 		Sorry, units does not exist! <a class="btn btn-primary" href="index.php">Back</a>
		</div><?php
	}
?>