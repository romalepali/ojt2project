<?php
	if(is_numeric($_GET['profile_id']) && $_GET['profile_id']!=0){
		$test_query="SELECT a.*,b.type AS 'utype' FROM users_list a LEFT JOIN users_type b ON a.type=b.id WHERE a.id=".$_GET['profile_id'];

		$test_result=mysqli_query($conn,$test_query);
		if(mysqli_num_rows($test_result)>0){
			$test=mysqli_fetch_array($test_result);?>
			<title>Profile | <?php echo $test['firstname']." ".$test['lastname'];?></title>
			<?php
				if($test['id'] != $_SESSION['user_id']){
					include ('view_user/user_profile.php');
				}else{?>
					<div style="padding: 0px 10px">
						This is your profile! <a class="btn btn-primary" href="profile.php?type=view">View</a>
					</div><?php
				}
		}else{?>
			<div style="padding: 0px 10px">
				Sorry, user does not exist! <a class="btn btn-primary" href="index.php">Back</a>
			</div><?php
		} 
	}else{?>
		<div style="padding: 0px 10px">
			Sorry, user does not exist! <a class="btn btn-primary" href="index.php">Back</a>
		</div><?php
	}
?>