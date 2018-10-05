<?php
	include ('config/su_verify.php');

	$profile_query="SELECT a.*,b.type AS 'utype' FROM users_list a LEFT JOIN users_type b ON a.type=b.id WHERE a.id=".$_SESSION['user_id'];
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
		<div id="content"><?php
			if(isset($_GET['type'])){?>
				<div class="row my-2">
					<div class="col-lg-2 order-lg-1 text-center">
						<img src="../uploads/images/<?php echo $pic;?>" class="mx-auto img-fluid img-circle d-block profile" alt="avatar">
						<?php include ('operations/account/profile_upload.php');?>
					</div><?php
					if($_GET['type']=='view'){
						include ('profile/view_profile.php');
					}else if($_GET['type']=='edit'){
						include ('profile/edit_profile.php');
					}else if($_GET['type']=='change'){
						include ('profile/change_password.php');
					}?>
				</div><?php
			}?>
		</div>
	</div>
</body>

<script type="text/javascript">
	document.getElementById("file").onchange = function() {
		document.getElementById("form").submit();
	};
</script>
</html>