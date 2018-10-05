<?php
	if(is_numeric($_GET['edit']) && $_GET['edit']!=0){
		$query0="SELECT * FROM jobbings_kinds WHERE id=".$_GET['edit'];
		$result_set0=mysqli_query($conn,$query0);
		if(mysqli_num_rows($result_set0)>0){
			$row0=mysqli_fetch_array($result_set0);?>
			<div class="row">
				<div class="col-10">
					<h4 style="margin: 10px 0px;"><?php echo $row0['kind_of_job'];?></h4>
				</div>
			</div>
			<div style="max-height: 75vh; overflow-x: hidden; padding: 0px 10px">
		<?php
			include ('edit/edit_jk.php');
		}
		else {?>
			<div style="max-height: 75vh; overflow-x: hidden; padding: 20px 10px">
				Sorry, job kind does not exist! <a class="btn btn-primary" href="<?php echo $_SESSION['page'];?>">Back</a>
			</div>
		<?php
		} 
 	}else {?>
		<div style="max-height: 75vh; overflow-x: hidden; padding: 20px 10px">
	 		Sorry, job kind does not exist! <a class="btn btn-primary" href="<?php echo $_SESSION['page'];?>">Back</a>
		</div>
 	<?php
	}
?>