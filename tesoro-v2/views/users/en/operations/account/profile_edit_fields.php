<?php 
if(isset($_POST['e_save']) && $_POST['e_save']=='true'){
	$fn = $_POST['fn'];
	$mn = $_POST['mn'];
	$ln = $_POST['ln'];
	$bd = $_POST['bd'];
	$email = $_POST['email'];
	$un = $_POST['un'];

	$update_info = "UPDATE users_list SET firstname='$fn',middlename='$mn',lastname='$ln',birthdate='$bd',email='$email',username='$un' WHERE id=".$_SESSION['user_id'];

	if(mysqli_query($conn,$update_info)){
	?>
	<script type="text/javascript">
		swal({
			title: "Success",
			text: "Your updates are applied!",
			type: "success"
		},
		function(isConfirm) {
			if (isConfirm) {
				window.location.href='<?php echo $_SESSION['page'];?>';
			}
		});
	</script>
	<?php
	}else{
	?>
	<script type="text/javascript">
		swal({
			title: "Failed",
			text: "No updates applied!",
			type: "error"
		},
		function(isConfirm) {
			if (isConfirm) {
				window.location.href='<?php echo $_SESSION['page'];?>?view=<?php echo $_GET['view']?>';
			}
		});
	</script>
	<?php
	}
}

if(isset($_POST['edit']) && $_POST['edit']=='true'){?>
<form role="form" method="POST">
	<div class="form-group row">
		<label class="col-lg-2 col-form-label form-control-label">First Name</label>
		<div class="col-lg-10">
			<input class="form-control" name="fn" type="text" value="<?php echo $profile['firstname'];?>" required>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-lg-2 col-form-label form-control-label">Middle Name</label>
		<div class="col-lg-10">
			<input class="form-control" name="mn" type="text" value="<?php echo $profile['middlename'];?>" required>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-lg-2 col-form-label form-control-label">Last Name</label>
		<div class="col-lg-10">
			<input class="form-control" name="ln" type="text" value="<?php echo $profile['lastname'];?>" required>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-lg-2 col-form-label form-control-label">Birthdate</label>
		<div class="col-lg-10">
			<input class="form-control" name="bd" type="date" value="<?php echo $profile['birthdate'];?>" required>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-lg-2 col-form-label form-control-label">Email</label>
		<div class="col-lg-10">
			<input class="form-control" name="email" type="email" value="<?php echo $profile['email'];?>" required>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-lg-2 col-form-label form-control-label">Username</label>
		<div class="col-lg-10">
			<input class="form-control" name="un" type="text" value="<?php echo $profile['username'];?>" required>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-lg-2 col-form-label form-control-label"></label>
		<div class="col-lg-10">
			<a href="profile.php?type=edit" class="btn btn-secondary">Cancel</a>
			<button type="submit" name="e_save" value="true" class="btn btn-primary">Save Changes</button>
		</div>
	</div>
</form>
<?php
}else{ ?>
<form role="form" method="POST">
	<div class="form-group row">
		<label class="col-lg-2 col-form-label form-control-label">First Name</label>
		<div class="col-lg-10">
			<input class="form-control" type="text" value="<?php echo $profile['firstname'];?>" disabled>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-lg-2 col-form-label form-control-label">Middle Name</label>
		<div class="col-lg-10">
			<input class="form-control" type="text" value="<?php echo $profile['middlename'];?>" disabled>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-lg-2 col-form-label form-control-label">Last Name</label>
		<div class="col-lg-10">
			<input class="form-control" type="text" value="<?php echo $profile['lastname'];?>" disabled>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-lg-2 col-form-label form-control-label">Birthdate</label>
		<div class="col-lg-10">
			<input class="form-control" type="text" value="<?php echo date('F d, Y',strtotime($profile['birthdate']));?>" disabled>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-lg-2 col-form-label form-control-label">Email</label>
		<div class="col-lg-10">
			<input class="form-control" type="email" value="<?php echo $profile['email'];?>" disabled>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-lg-2 col-form-label form-control-label">Username</label>
		<div class="col-lg-10">
			<input class="form-control" type="text" value="<?php echo $profile['username'];?>" disabled>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-lg-2 col-form-label form-control-label"></label>
		<div class="col-lg-10">
			<button type="submit" class="btn btn-primary" value="true" name="edit">Edit Profile</button>
		</div>
	</div>
</form>
<?php }?>