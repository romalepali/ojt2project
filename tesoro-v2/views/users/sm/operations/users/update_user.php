<?php
	if(is_numeric($_GET['update']) && $_GET['update']!=0){
		$query0="SELECT * FROM users_list WHERE type!=2 && id=".$_GET['update'];
		$result_set0=mysqli_query($conn,$query0);
		if(mysqli_num_rows($result_set0)>0){
			$row0=mysqli_fetch_array($result_set0);?>
			<title><?php echo $row0['firstname']." ".$row0['lastname'];?> | Update Account</title>
			<div class="row">
				<div class="col-10">
					<h4 style="margin: 10px 0px;"><?php echo $row0['lastname'].", ".$row0['firstname']." ".$row0['middlename'];?></h4>
				</div>
			</div>
			<div style="padding: 0px 10px"><?php
				include ('update/update_status.php');?>
			</div><?php
		}else{?>
			<div style="padding: 20px 10px">
				Sorry, user does not exist! <a class="btn btn-primary" href="<?php echo $_SESSION['page'];?>">Back</a>
			</div><?php
		} 
	}else{?>
		<div style="max-height: 75vh; overflow-x: hidden; padding: 20px 10px">
			Sorry, user does not exist! <a class="btn btn-primary" href="<?php echo $_SESSION['page'];?>">Back</a>
		</div><?php
	}
?>