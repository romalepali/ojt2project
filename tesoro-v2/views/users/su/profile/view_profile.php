<?php
	$_SESSION['page']='profile.php?type=view';
?>
<div class="col-lg-10 order-lg-2">
	<ul class="nav nav-tabs">
		<li class="nav-item">
			<a href="profile.php?type=view" class="nav-link active">Profile</a>
		</li>
		<li class="nav-item">
			<a href="profile.php?type=edit" class="nav-link">Edit Profile</a>
		</li>
		<li class="nav-item">
			<a href="profile.php?type=change" class="nav-link">Change Password</a>
		</li>
	</ul>
	<div class="tab-content py-4">
		<div class="tab-pane active" id="profile">
			<h4 class="mb-0"><?php echo $profile['firstname']." ".$profile['middlename']." ".$profile['lastname'];?></h4>
			<h6 class="mb-3"><?php echo $profile['utype'];?></h6>
			<div class="row">
				<div class="col-md-6">
					<p class="mb-1">
						<strong>Gender:</strong> <?php echo $profile['gender'];?>
					</p>
					<p class="mb-1">
						<strong>Birthdate:</strong> <?php echo date("F d, Y",strtotime($profile['birthdate']));?>
					</p>
					<p class="mb-1">
						<strong>Email:</strong> <?php echo '<a target="_T" href="mailto:'.$profile['email'].'">'.$profile['email'].'</a>';?>
					</p>
				</div>
			</div>
		</div>
	</div>
</div>