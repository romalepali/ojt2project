<?php
 if(is_numeric($_GET['edit']) && $_GET['edit']!=0){
	$query0="SELECT a.job_no AS 'jon', b.type AS 'type' FROM jobbings a INNER JOIN jobbings_kinds b ON a.job_kind=b.id WHERE a.id=".$_GET['edit'];

	$result_set0=mysqli_query($conn,$query0);
	if(mysqli_num_rows($result_set0)>0){
	 $row0=mysqli_fetch_array($result_set0);?>
	 <div class="row">
		<div class="col-10">
			<h4 style="margin: 10px 0px;">J.O. No.: <?php echo $row0['jon'];?></h4>
		</div>
	</div>
	<div style="max-height: 75vh; overflow-x: hidden; padding: 0px 10px">
	 <?php if($row0['type']==1){
	 ?>
        Sorry, this job is under big job category. <a class="btn btn-primary" href="<?php echo $_SESSION['page'];?>">Back</a>
      <?php
	 }
	 else if($row0['type']==2){
	 //Small Jobs Only
	include ('edit/edit_small.php');
	 } else if($row0['type']==3){
	 ?>
        Sorry, this job is under big job - small category. <a class="btn btn-primary" href="<?php echo $_SESSION['page'];?>">Back</a>
      <?php
	 }?>
	 </div>
	 <?php
	} else {?>
	 <div style="max-height: 75vh; overflow-x: hidden; padding: 20px 10px">
		Sorry, job does not exist! <a class="btn btn-primary" href="<?php echo $_SESSION['page'];?>">Back</a>
	 </div>
	<?php
	} 
 }else {?>
	<div style="max-height: 75vh; overflow-x: hidden; padding: 20px 10px">
	 Sorry, job does not exist! <a class="btn btn-primary" href="<?php echo $_SESSION['page'];?>">Back</a>
	</div>
 <?php
 }
?>