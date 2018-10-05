<?php
	$_SESSION['page']='profile.php?type=change';
?>
<div class="col-lg-10 order-lg-2">
	<ul class="nav nav-tabs">
		<li class="nav-item">
			<a href="profile.php?type=view" class="nav-link">Profile</a>
		</li>
		<li class="nav-item">
			<a href="profile.php?type=edit" class="nav-link">Edit Profile</a>
		</li>
		<li class="nav-item">
			<a href="profile.php?type=change" class="nav-link active">Change Password</a>
		</li>
	</ul>
	<div class="tab-content py-4">
		<div class="tab-pane active" id="change">
			<?php include ('operations/account/profile_change_fields.php');?>
		</div>
	</div>
</div>