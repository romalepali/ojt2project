<?php
	include ('config/sm_verify.php');

	$count_query="SELECT count(status) AS 'ucount' FROM users_list WHERE type!=2";
	$count_result=mysqli_query($conn,$count_query);

	$active_query="SELECT count(status) AS 'ucount' FROM users_list WHERE (type!=2 && status='Active')";
	$active_result=mysqli_query($conn,$active_query);

	$inactive_query="SELECT count(status) AS 'ucount' FROM users_list WHERE (type!=2 && status='Inactive')";
	$inactive_result=mysqli_query($conn,$inactive_query);

	$users_query="SELECT * FROM users_type WHERE id!=1";
	$users_result=mysqli_query($conn,$users_query);
?>

<!DOCTYPE html>
<html>
<head>
	<?php include ('include/head.php');?>
</head>

<style type="text/css">
	.nav-users {
		text-decoration: none;
		color: #fff;
		background: rgba(0,0,0,.4);
	}
	thead,tbody {
		font-size: 15px;
	}
</style>

<body>
	<?php include ('include/navbar.php');?>
	<div class="container-fluid">
		<div id="content">
			<div class="row">
				<div class="col-md-12"><?php
					if(
						(isset($_GET['update']) || !isset($_GET['remove']) && !isset($_GET['create'])) &&
						(!isset($_GET['update']) || isset($_GET['remove']) && !isset($_GET['create'])) &&
						(!isset($_GET['update']) || !isset($_GET['remove']) && isset($_GET['create']))
					) {?>
						<div style="margin-top: 50px;"><?php
							if(isset($_GET['users'])){
								if($_GET['users']=='all'){
									include ('ulist/all.php');
								}else if($_GET['users']=='active'){
									include ('ulist/active.php');
								}else if($_GET['users']=='inactive'){
									include ('ulist/inactive.php');
								}
							}?>
						</div><?php
					} else{?>
						<div style="margin-top: 50px;">
							<ul id="tabsJustified" class="nav nav-tabs" id="tabs">
								<li class="nav-item">
									<a href="users.php?users=all" class="nav-link small text-uppercase">
										All
										<span class="float-right badge badge-pill badge-danger" style="margin-left:10px"><?php
											if(mysqli_num_rows($count_result)>0){
												while($count=mysqli_fetch_assoc($count_result)){
													echo $count['ucount'];
												}
											}?>
										</span>
									</a>
								</li>
								<li class="nav-item">
									<a href="users.php?users=active" class="nav-link small text-uppercase">
										Active
										<span class="float-right badge badge-pill badge-danger" style="margin-left:10px"><?php
											if(mysqli_num_rows($active_result)>0){
												while($active=mysqli_fetch_assoc($active_result)){
													echo $active['ucount'];
												}
											}?>
										</span>
									</a>
								</li>
								<li class="nav-item">
									<a href="users.php?users=inactive" class="nav-link small text-uppercase">
										Inactive
										<span class="float-right badge badge-pill badge-danger" style="margin-left:10px"><?php
											if(mysqli_num_rows($inactive_result)>0){
												while($inactive=mysqli_fetch_assoc($inactive_result)){
													echo $inactive['ucount'];
												}
											}?>
										</span>
									</a>
								</li>
							</ul>
						</div><?php
						if(isset($_GET['update'])){
							include ('operations/users/update_user.php');
						} else if(isset($_GET['remove'])){
							include ('operations/users/remove_user.php');
						} else if(isset($_GET['create'])){
							include ('ulist/create.php');
						}
					}?>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="createA">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Create An Account</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">
					<div class="row"><?php
						$ut_query = "SELECT * FROM users_type";
						$ut_result=mysqli_query($conn,$ut_query);
						if(mysqli_num_rows($ut_result)>0){
							while($ut=mysqli_fetch_assoc($ut_result)){?>
								<div class="col mb-2">
									<a class="btn btn-secondary form-control" href="javascript: create('<?php echo $ut['id'];?>')"><?php echo $ut['type'];?></a>
								</div><?php
							}
						}else {?>
							<div class="col">
								Not Available
							</div><?php
						}?>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<script src="js/system/users.js"></script>
</body>
</html>