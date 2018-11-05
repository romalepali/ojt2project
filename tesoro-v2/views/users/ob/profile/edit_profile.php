<?php
	$_SESSION['page']='profile.php?type=edit';
?>
<title>Edit Profile</title>
<div class="col-lg-10 order-lg-2">
	<ul class="nav nav-tabs">
		<li class="nav-item">
			<a href="profile.php?type=view" class="nav-link">My Profile</a>
		</li>
		<li class="nav-item">
			<a href="profile.php?type=edit" class="nav-link active">Edit Profile</a>
		</li>
		<li class="nav-item">
			<a href="profile.php?type=change" class="nav-link">Change Password</a>
		</li>
	</ul>
	<div class="tab-content py-4">
		<div class="tab-pane active" id="edit">
			<?php include ('operations/account/profile_edit_fields.php');?>
		</div>
	</div>
</div>