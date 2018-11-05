<?php
	$_SESSION['page']='profile.php?type=view';

	$ppic = '';
	if($test['picture']!='default'){
		$ppic = $test['picture'].".png";
	}else{
		$ppic = $test['picture']."2.png";
	}
?>

<div class="col-lg-2 order-lg-1 text-center">
	<img src="../uploads/images/<?php echo $ppic;?>" class="mx-auto img-fluid img-circle d-block profile" alt="avatar">
</div>

<div class="col-lg-10 order-lg-2">
	<ul class="nav nav-tabs">
		<li class="nav-item">
			<a href="profile.php?profile_id=<?php echo $_GET['profile_id'];?>" class="nav-link active">Profile</a>
		</li>
	</ul>
	<div class="tab-content py-4">
		<div class="tab-pane active" id="profile">
			<h4 class="mb-0"><?php echo $test['firstname']." ".$test['middlename']." ".$test['lastname'];?></h4>
			<h6 class="mb-3"><?php echo $test['utype'];?></h6>
			<div class="row">
				<div class="col-md-6">
					<p class="mb-1">
						<strong>Gender:</strong> <?php echo $test['gender'];?>
					</p>
					<p class="mb-1">
						<strong>Birthdate:</strong> <?php echo date("F d, Y",strtotime($test['birthdate']));?>
					</p>
					<p class="mb-1">
						<strong>Email:</strong> <?php echo '<a target="_T" href="mailto:'.$test['email'].'">'.$test['email'].'</a>';?>
					</p>
				</div>
			</div>
		</div>
	</div>
</div>