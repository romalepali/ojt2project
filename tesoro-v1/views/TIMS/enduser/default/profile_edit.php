<?php
	include ('TIMS_verify.php');
	$_SESSION['page']='profile_edit.php';

	$profile_query="SELECT a.*,b.name FROM users a LEFT JOIN users_privileges b ON a.type=b.id WHERE a.id=".$_SESSION['TIMS_id'];
	$profile_result=mysqli_query($conn,$profile_query);
	$profile=mysqli_fetch_array($profile_result);

	$pic = '';
	if($profile['picture']!='default'){
		$pic = $profile['picture'].".png";
	}else{
		$pic = $profile['picture']."2.png";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
	<?php include ('include/head.php')?>
</head>

<body>
	<?php include ('include/navbar.php')?>
	<div class="gap"></div>
	<div class="container-fluid">
		<div id="content">
			<div class="row my-2">
				<div class="col-lg-2 order-lg-1 text-center">
					<img src="../../users/images/<?php echo $pic;?>" class="mx-auto img-fluid img-circle d-block profile" alt="avatar">
					<?php include ('account/profile_upload.php');?>
				</div>
				<div class="col-lg-10 order-lg-2">
					<ul class="nav nav-tabs">
						<li class="nav-item">
							<a href="profile.php" class="nav-link">Profile</a>
						</li>
						<li class="nav-item">
							<a href="#" data-target="#edit" data-toggle="tab" class="nav-link active">Edit Profile</a>
						</li>
						<li class="nav-item">
							<a href="profile_change.php" class="nav-link">Change Password</a>
						</li>
					</ul>
					<div class="tab-content py-4">
						<div class="tab-pane active" id="edit">
							<?php include ('account/profile_edit.php');?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

<script type="text/javascript">
	document.getElementById("file").onchange = function() {
		document.getElementById("form").submit();
	};
</script>
</html>